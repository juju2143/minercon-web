minercon-web is a simple web interface to Minecraft's remote console, so you can remotely admin your Minecraft server without messing with SSH and screen.

Usage
=====

To install this, you'll need a simple Apache+PHP server or hosting. Dump the files in a folder of your document root and voilà.
<br/>You also must have enable-rcon=true and rcon.password set in your server's server.properties like this:

> enable-rcon=true
> <br/>rcon.password=*password*
> <br/>rcon.port=25575 *(optional)*

Server: Input the IP or hostname of your server, with optionally the port (default is 25575).
<br/>Examples:

> 192.168.1.2
> <br/>mc.example.net
> <br/>mc.example.net:25575

Password: The password you defined in rcon.password. Notice that you can't see what you're typing, not even stars, as it is the custom on most UNIX systems.

rcon>: You're now ready to type your commands in. If you're confused, you can always type *help*. You can logout by reloading the page.

Links
=====

Live demo: http://minercon.julosoft.net
<br/>Based on JulOS 2.0 (http://julosoft.net) and MinecraftRCon.class.php (https://github.com/xPaw/PHP-Minecraft-Query)
<br/>http://juju2143.ca