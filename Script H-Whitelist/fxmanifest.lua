fx_version 'adamant'
game 'gta5'
description 'H-Whitelist'
version '1.0'

server_scripts {
	'@mysql-async/lib/MySQL.lua',
	'locale.lua',
	'locales/fr.lua',
	'config.lua',
	'server/server.lua'
}


dependencies {
	'mysql-async'
}
