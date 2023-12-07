# MinecraftServer Docker Image
Easily deploy and manage Minecraft servers with unrivalled flexibility and speed, thanks to our Docker images optimized for maximum elasticity.

# Why ?
Most Minecraft server images available on Docker are often frozen in time, rarely updated and limited in their flexibility to meet advanced user needs.

These standardized images do not always allow easy integration of crucial functions such as :
- advanced management via RCON
- data retrieval via the query protocol
- access to the Minecraft server terminal directly from the Docker terminal.

Our approach is based on the creation of optimized Docker images, offering unrivalled flexibility for an advanced user experience, enabling full exploitation of the Minecraft server's extensive functionality while guaranteeing regular updates for optimal security and performance.

# How ?
Minecraft Server isn't based on an existing docker image, but was created from 2 elements essential to docker image creation: 
- a short and precise dockerfile
- an entrypoint containing all functions to be executed when the image is launched

Minecraft server is initially based on the [bookworm-slim debian](https://hub.docker.com/_/debian) distribution, and then uses two main programs to manage the minecraft server:
- [Screen](https://doc.ubuntu-fr.org/screen) to manage the terminal server integrated into the docker terminal
- [openjdk-17-jdk-headless](https://packages.debian.org/bookworm/openjdk-17-jdk-headless) for launching and managing the mineraft server.

In a second step, the image downloads the minecraft server file from the mojang servers, exposes two ports corresponding to the rcon and server/query ports and finally copies and places the entrypoint at container startup.

Finally, when the container starts and executes the entrypoint, the minecraft server creates the files needed by the minecraft server, checks the integrity of the mojang .jar server file and finishes by launching the screen containing the minecraft server, while at the same time running a check that stops the container when the minecraft server is stopped or crashes.

# Getting started
### First step
You need to have [docker desktop](https://www.docker.com/products/docker-desktop/) >= 4.15.0 or [docker engine](https://docs.docker.com/engine/install/debian/) installed.

### Second step
there are two ways to pull the minecraft server image :
- without tag, it will automatically download the latest vanilla version of minecraft
```bash
docker pull thorbeorn/minecraftserver
```
- with [composed tag](#composed-tag), the [composed tag](#composed-tag) is separated into two parts, the distro and the minecraft version (list of tags in next section)
```bash
docker pull thorbeorn/minecraftserver:spigot-1.12.2
```

### Third step
To start a container with our image, there's one main factor to take into account: [environment variables](#environment-variables) (list of tags in next section) :
- without [environment variables](#environment-variables), booting without [environment variables](#environment-variables) will keep the default boot values (2g RAM and QUERY/RCON disabled).
```bash
docker run --name minecraft -it thorbeorn/minecraftserver
docker run --name minecraft -it thorbeorn/minecraftserver:spigot-1.12.2
```

- with [environment variables](#environment-variables), starting with [environment variables](#environment-variables) will change the server parameters to match the expected value.
**example** : server with rcon and query so 2G RAM for startup and 2G for execution
```bash
docker run --name minecraft -it \
-e xms=2G -e xmx=4G \
-e enablercon=true -e rconpassword="test" \
-e enablequery=true \
thorbeorn/minecraftserver:vanilla-1.7.10
```

### Fourth step (optional)
pour cette derniere partie optionnel, nous allons monter un volume entre le server et le container afin d'acceder au fichier server pour modifier des fichiers etc.

> [!CAUTION]
> **avant de commencer** il faut prendre en compte le fait que les fichiers seront supprimer du container puis reécrit sur le volume partager

> [!IMPORTANT] 
> **Some server properties can't be changed from the server.properties file** because the [environment variables](#environment-variables) override any changes made to the file (example: the [environment variables](#environment-variables) indicates that the query is enabled; if you disable the query in the server.properties file, it will be changed the next time you restart).
> Here are the properties that need to be changed in [environment variables](#environment-variables): 
> - enable-query
> - enable-rcon
> - rcon.password

> [!TIP]
> In accordance with the [environment variables](#environment-variables) section, you can retain full control of the server from the server.properties file by using the [environment variables](#environment-variables).
>```
>-e enableServerPropertiesFile=true
>```

# Composed tag
the minecraft server image is used to create minecraft server containers. To choose the server version we use a compound tag, i.e. we can choose the server type such as vanilla, spigot etc. and choose the game version such as 1.2.5, 1.7.10 etc.

to pull a specific image we use the following image with the compound tag :
**thorbeorn/minecraftserver:xx-yy**
> xx -> corresponds to server distribution (vanilla, spigot etc).
>
> yy -> corresponds to the server version (1.2.5, 1.7.10, etc.).

### Available distribution
- vanilla

### Available version
- 1.2.5

# Environment variables
les variable d'environnement sont utilisé pour gerer les fonctions principales du server comme sa RAM ou les protocoles activé.

Voici un tableau correspondant au clé/valeur de chaque variable d'environnement ainsi que leur description
 
-e enablequery=[true/false]
-e enablercon=[true/false]
-e rconpassword="[password]"
-e enableServerPropertiesFile=[true/false]
xms
xmx
etc