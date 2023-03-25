<?php

namespace App\Enso\Newsletters;

use App\Mail\UserEnquiry;
use App\Utilities\EmailValidator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Yadda\Enso\Facades\EnsoCrud;
use Yadda\Enso\Newsletter\Contracts\NewsletterHandlerContract;
use Yadda\Enso\Newsletter\Contracts\NewsletterModelContract;
use Yadda\Enso\Newsletter\Traits\HasGenericFormData;
use Yadda\Enso\Newsletter\Traits\SendNewsletterToMailchimp;
use Yadda\Enso\Newsletter\Traits\WriteNewsletterToDatabase;
use Yadda\Enso\Settings\Facades\EnsoSettings;

class EnquiryForm implements NewsletterHandlerContract
{
    use HasGenericFormData;
    use SendNewsletterToMailchimp;
    use WriteNewsletterToDatabase;

    /**
     * Get a csv string of email addresses to send to
     *
     * @return string
     */
    protected function adminEmailAddresses(string $branch): array
    {
        $location = EnsoCrud::query('location')->where('slug', $branch)->first();

        $setting_emails = array_merge(
            array_map('trim', array_filter(explode(',', EnsoSettings::get('administrator-email', '')))),
            $location ? array_map('trim', array_filter(explode(',', $location->admin_emails))) : [],
        );

        if (empty($setting_emails)) {
            return [];
        }

        return (new Collection($setting_emails))->filter(function ($email) {
            return EmailValidator::isValid($email);
        })->toArray();
    }

    /**
     * Saves a request to the database
     *
     * @param array $request_data
     *
     * @return void
     */
    protected function emailAdmins(array $request_data, NewsletterModelContract $newsletter = null): void
    {
        if (!$newsletter) {
            return;
        }

        $emails = $this->adminEmailAddresses(Arr::get($request_data, 'branch'));

        if (empty($emails)) {
            Log::warning('Tried to send EnsoNewsletters email to admin but no admin address found.');
            return;
        }

        Mail::to($emails)->send(new UserEnquiry($newsletter));
    }

    /**
     * Gets the important Form data for displaying on index pages
     *
     * @param Model $newsletter
     *
     * @return array
     */
    public static function getImportantFormData(Model $newsletter): array
    {
        return [
            'email' => $newsletter->email,
        ];
    }

    /**
     * Pluck merge data from the request data.
     *
     * @param array $request_data
     *
     * @return array
     */
    protected function mailchimpMergeData(array $request_data): array
    {
        return array_filter([
            'NAME' => Arr::get($request_data, 'name'),
            'PHONE' => Arr::get($request_data, 'phone'),
        ]);
    }

    /**
     * Handle the request data
     *
     * @param array $request_data
     *
     * @return mixed
     */
    public function handle(array $request_data)
    {
        $newsletter = $this->writeToDatabase($request_data);

        $this->emailAdmins($request_data, $newsletter);

        if (Config::get('newsletter.apiKey')) {
            $this->sendToMailchimp($request_data);
        }
    }

    /**
     * Validation messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Validation rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [];
    }
}
