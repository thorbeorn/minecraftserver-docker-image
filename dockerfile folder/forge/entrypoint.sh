#!/bin/bash

# Fonction pour arrêter le serveur et fermer le conteneur
stop_server() {
    screen -S minecraft -X stuff "stop$(printf '\r')"
    sleep 2
    screen -S minecraft -X quit
    exit
}

# Fonction de capture de l'arrêt du serveur
trap 'stop_server' SIGINT SIGTERM

#init des fichiers pour le demarrage
touch banned-players.txt
touch banned-ips.txt
touch ops.txt
touch white-list.txt
touch server.properties
echo "eula=true" > eula.txt

if [ "$enableServerPropertiesFile" = "false" ]; 
then
   if grep -q enable-query= server.properties
   then
      sed -i "s/^enable-query=.*/enable-query=$enablequery/" server.properties
   else
      echo "enable-query=$enablequery" >> /minecraft/server.properties
   fi
   if grep -q enable-rcon= server.properties
   then
      sed -i "s/^enable-rcon=.*/enable-rcon=$enablercon/" server.properties
   else
      echo "enable-rcon=$enablercon" >> /minecraft/server.properties
   fi
   if grep -q rcon.password= server.properties
   then
      sed -i "s/^rcon.password=.*/rcon.password=$rconpassword/" server.properties
   else
      echo "rcon.password=$rconpassword" >> /minecraft/server.properties
   fi
fi

if ! diff -r /libraries /minecraft/libraries >/dev/null; then
   cp -rf /libraries /minecraft/libraries
fi

cmp --silent /forgeserver.jar forgeserver.jar || cp -f /forgeserver.jar forgeserver.jar
cmp --silent /minecraft_server.* minecraft_server.* || cp -f /minecraft_server.* .

# Démarrage du serveur Minecraft dans un screen
screen -S minecraft -m java -Xms$xms -Xmx$xmx -jar forgeserver.jar

# Boucle pour surveiller l'état du serveur
while screen -list | grep -q minecraft; do
    sleep 1
done

# Lorsque le serveur s'arrête, fermer le conteneur
stop_server