# Lazer Reviews v0.0.0.0.1
<h2>Added libraries: </h2>
<em>Bootstrap (laravel\\public), Socialite(laravel\\vendor\\laravel\\socialite), and HTML helper (laravel\\vendor\\laravelcollective\\) </em>

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
