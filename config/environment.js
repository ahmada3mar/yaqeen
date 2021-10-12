var environments = {
	staging: {
		FIREBASE_API_KEY: 'AIzaSyCju-iEhwQy5XtyaaoB2Dzda2BRF2NTt9s',
		FIREBASE_AUTH_DOMAIN: 'yaqeen-f280e.firebaseapp.com',
		FIREBASE_DATABASE_URL: 'https://yaqeen-f280e-default-rtdb.firebaseio.com',
		FIREBASE_PROJECT_ID: 'yaqeen-f280e',
		FIREBASE_STORAGE_BUCKET: 'yaqeen-f280e.appspot.com',
		FIREBASE_MESSAGING_SENDER_ID: '468022334784',
		GOOGLE_CLOUD_VISION_API_KEY: 'AIzaSyC5u6dGMtNGkQBDx6QCaVWCPwCaCGh6b8g'
	},
	production: {
		// Warning: This file still gets included in your native binary and is not a secure way to store secrets if you build for the app stores. Details: https://github.com/expo/expo/issues/83
	}
};

function getReleaseChannel() {
 
  
    return 'staging';
 
}
function getEnvironment(env) {
  console.log('Release Channel: ', getReleaseChannel());
  return environments[env];
}
var Environment = getEnvironment(getReleaseChannel());
export default Environment;