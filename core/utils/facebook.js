'use strict';

var FB = require('fb');
var _ = require('underscore')

var facebookUtils = {

	getOffres(data) {
		return _.filter(data, function(post) {
			return /#offre/.test(post.message)
		})
	},

	getActus(data) {
		return _.filter(data, function(post) {
			return /#actu/.test(post.message)
		})
	},

	getData(cb) {
		FB.api('oauth/access_token', {
      client_id: '679094615578640',
      client_secret: 'a70b37780e9548e0b2a5a75c327d14b5',
      grant_type: 'client_credentials'
    }, function (result) {
      if(!result || result.error) {
        console.log(!result ? 'error occurred' : result.error);
        return;
      }

      var accessToken = result.access_token;

      FB.setAccessToken(accessToken);
      FB.api(
        "/168855449803336/feed",
        function (response) {
          if (response && !response.error) {
          	cb(false, response.data);
          }
        }
      );
    });
	}
};

module.exports = facebookUtils;