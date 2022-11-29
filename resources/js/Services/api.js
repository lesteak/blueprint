import axios from 'axios';

export default {
  async get(route, params = {}, config = {}) {
    config = Object.assign(
      {
        responseType: 'json',
        params,
      },
      config
    );

    return axios.get(
      route,
      config
    );
  },

  async post(route, params = {}, config = {}) {
    config = Object.assign(
      {
        responseType: 'json',
      },
      config
    );

    return axios.post(
      route,
      params,
      config
    );
  },

  async patch(route, params = {}, config = {}) {
    config = Object.assign(
      {
        responseType: 'json',
      },
      config
    );

    return axios.patch(
      route,
      params,
      config
    );
  },
};
