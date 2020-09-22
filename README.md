<p align="center"><img height="188" width="198" src="https://botman.io/img/botman.png"></p>
<h1 align="center">BotMan Studio</h1>

## About BotMan Studio

While BotMan itself is framework agnostic, BotMan is also available as a bundle with the great [Laravel](https://laravel.com) PHP framework. This bundled version is called BotMan Studio and makes your chatbot development experience even better. By providing testing tools, an out of the box web driver implementation and additional tools like an enhanced CLI with driver installation, class generation and configuration support, it speeds up the development significantly.

## Documentation

You can find the BotMan and BotMan Studio documentation at [http://botman.io](http://botman.io).

## Steps
- Install the app `composer install`
- Serve the app `php artisan serve`

## Integrate with facebook messenger
# Steps: ( Reference: https://botman.io/2.0/driver-facebook-messenger )
- install facebook driver ( check the doc )
- Add the following: 
  + FACEBOOK_TOKEN=your-facebook-page-token
  + FACEBOOK_VERIFICATION=your-facebook-verification-token
  + FACEBOOK_APP_SECRET=your-facebook-app-secret
  * Official guideline here to test out => `https://developers.facebook.com/docs/messenger-platform/getting-started/quick-start`
- To be able to integrate you'll need HTTPs protocol. For this u can use `ngrok` to host your localhost.
- `FACEBOOK_VERIFICATION` is what you added by yourself to verify your connection between facebook and your app. ( you can put anything u want. but when you add the webhook they are needed to be matched. ).
- After hosing ur localhost by `ngrok` u should be able to add ur webhook in facebook developer dashboard page. `example: {ur https ngrok}/botman`
- `FACEBOOK_TOKEN` is retrieved by `token generation` after adding your webhook in Messenger product (located in develop facebook dashboard sidebar)
- `FACEBOOK_TOKEN` is retrieved by `Dashboard => Setting => Basic`.
- Test your connection out with postman. `E.g: https://{your ngrok or your site }/botman?hub.verify_token={your manual token in env}&hub.challenge=CHALLENGE_ACCEPTED&hub.mode=subscribe
- Restart your app once you successfully connected to the facebook.

# For botman facebook guideline and UI please check `https://botman.io/2.0/driver-facebook-messenger`


