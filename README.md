# Lazer Reviews v0.0.0.0.1
<h2>Added libraries: </h2>
<em>Bootstrap (laravel\\public), Socialite(laravel\\vendor\\laravel\\socialite), and HTML helper (laravel\\vendor\\laravelcollective\\) </em>

<h2>Amazon S3 Image Support Added</h2>
You are now able to upload images onto my bucket. Those images are then retrieved in the product page from my AWS S3 account.
Check out the code for that. If you get an SSL error, do the following:

<ul>
<li>Install certificate file, it's in the root of my branch <em>cacert.pem</em> </li>
<li>Change php.ini file to point to it. Change this option: <em>curl.cainfo = "c:/wamp/www/ChinchillaThrilla/laravel/cacert.pem"</em> </li>
<li>Done. It should work now.</li>
</ul>

<h2>API Key support added</h2>
To test simply add the X-Authorization header to your request. Views do not require an API key since any user should be able to look at products and things
of that such.
Use this key for now: <strong>0720a8c75b24bc9de4d548587ac41c85de4d8020</strong>

If you want to create a key for yourself, simply run this command:
<em>php artisan api-key:generate --user-id=1 </em> where 1 is the userID you are tying that key to.

<em>I've gone and created a way to give people API keys</em>

The controller is called APIController... but that requires a special key. Only we should be able to give out keys.

Put all this in your wamp folder. To test the controllers, user these URI's:
<ul>
<li> http://localhost:8000/</li>
<li> http://localhost:8000/profile</li>
<li> http://localhost:8000/about</li>
</ul>
<em> Port numbers might vary depending on your setup</em>

<em> The home page is using bootstrap, just wanted to show you that. I've commented everything. I show you how to include bootstrap using HTML helper. The profile page is also using bootstrap. Look over the master_page.blade.php to see how a master page works. That master page is then extended in the about.blade.php page. It extends the master page. That's all the code included. After you test it out, feel free to delete those files </em>


<h3>Files to delete: </h3>
<ul>
<li> user_account.blade.php</li>
<li> about.blade.php</li>
</ul>


Let me know if I can clarify anything... The rest of the files has not been touched, but I did want us to get up and running with the basics.
