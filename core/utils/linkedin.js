'use strict';

var linkedinUtils = {
	parse(rawData) {
		var data = {
			linkedin_id: rawData.id,
			username: rawData.displayName,
			first_name: rawData.name.givenName,
			last_name: rawData.name.familyName,
			email: rawData.emails[0].value,
			profile_pictures: rawData.photos[0].value,
			headline: rawData._json.headline,
			profil: rawData._json.publicProfileUrl,
			role: "student",
			validated: false
		}
		return data;
	}
}

module.exports = linkedinUtils;