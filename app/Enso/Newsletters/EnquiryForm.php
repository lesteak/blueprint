<?php

namespace App\Enso\Newsletters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Yadda\Enso\Newsletter\Contracts\NewsletterHandlerContract;
use Yadda\Enso\Newsletter\Traits\HasGenericFormData;
use Yadda\Enso\Newsletter\Traits\SendNewsletterToMailchimp;
use Yadda\Enso\Newsletter\Traits\WriteNewsletterToDatabase;

class EnquiryForm implements NewsletterHandlerContract
{
    use HasGenericFormData,
        SendNewsletterToMailchimp,
        WriteNewsletterToDatabase;

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
        $this->writeToDatabase($request_data);

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
