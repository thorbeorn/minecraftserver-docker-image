# MinecraftServer Docker Image
Easily deploy and manage Minecraft servers with unrivalled flexibility and speed, thanks to our Docker images optimized for maximum elasticity.

# Link to elements
[Github](https://github.com/thorbeorn/minecraftserver-docker-image)

[Docker hub](https://hub.docker.com/r/thorbeorndev/minecraftserver)

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

Minecraft server is initially based on the [jammy ubuntu](https://hub.docker.com/_/ubuntu) and [bookworm-slim debian](https://hub.docker.com/_/debian) distribution, and then uses two main programs to manage the minecraft server:
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
docker pull thorbeorndev/minecraftserver
```
- with [composed tag](#composed-tag), the [composed tag](#composed-tag) is separated into two parts, the distro and the minecraft version (list of tags in next section)
```bash
docker pull thorbeorndev/minecraftserver:spigot-1.12.2
```

### Third step
To start a container with our image, there's one main factor to take into account: [environment variables](#environment-variables) (list of tags in next section) :
- without [environment variables](#environment-variables), booting without [environment variables](#environment-variables) will keep the default boot values (2g RAM and QUERY/RCON disabled).
```bash
docker run --name minecraft -it -p 25565:25565 -p 25575:25575 thorbeorndev/minecraftserver
docker run --name minecraft -it -p 25565:25565 -p 25575:25575 thorbeorndev/minecraftserver:spigot-1.12.2
```

- with [environment variables](#environment-variables), starting with [environment variables](#environment-variables) will change the server parameters to match the expected value.
**example** : server with rcon and query so 2G RAM for startup and 2G for execution
```bash
docker run --name minecraft -it \
-p 25565:25565 -p 25575:25575 \
-e xms=2G -e xmx=4G \
-e enablercon=true -e rconpassword="test" \
-e enablequery=true \
thorbeorndev/minecraftserver:vanilla-1.7.10
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
**thorbeorndev/minecraftserver:xx-yy**
> xx -> corresponds to server distribution (vanilla, spigot etc).
>
> yy -> corresponds to the server version (1.2.5, 1.7.10, etc.).

### Available distribution/version
| Available distribution      | Compatible version   |
|:--------------------------- |:-------------------- |
| vanilla                     | - 1.2.5<br>- 1.3.x<br>- 1.4.x<br>- 1.5.x<br>- 1.6.x<br>- 1.7.x<br>- 1.8.x<br>- 1.9.x<br>- 1.10.x<br>- 1.11.x<br>- 1.12.x<br>- 1.13.x<br>- 1.14.x<br>- 1.15.x<br>- 1.16.x<br>- 1.17.x<br>- 1.18.x<br>- 1.19.x<br>- 1.20-1.20.3 |
| spigot                      | - 1.4.6-1.4.7<br>- 1.5.x<br>- 1.6.2<br>- 1.7.2<br>- 1.7.5<br>- 1.7.8-1.7.10<br>- 1.8<br>- 1.8.3-1.8.8<br>- 1.9<br>- 1.9.2<br>- 1.9.4<br>- 1.10<br>- 1.10.2<br>- 1.11.x<br>- 1.12.x<br>- 1.13.x<br>- 1.14.x<br>- 1.15.x<br>- 1.16.1-1.16.5<br>- 1.17.1<br>- 1.18.2<br>- 1.19.x<br>- 1.20-1.20.3 |
| craftbukkit                 | - 1.0.0<br>- 1.1<br>- 1.2.2-1.2.5<br>- 1.3.x<br>- 1.4.2<br>- 1.4.5-1.4.7<br>- 1.5.x<br>- 1.6.x<br>- 1.7.2<br>- 1.7.5<br>- 1.7.8-1.7.10<br>- 1.8<br>- 1.8.3-1.8.8<br>- 1.9<br>- 1.9.2<br>- 1.9.4<br>- 1.10<br>- 1.10.2<br>- 1.11.x<br>- 1.12.x<br>- 1.13.x<br>- 1.14.x<br>- 1.15.x<br>- 1.16.1-1.16.5<br>- 1.20.1-1.20.2 |
| paper                       | - 1.8.8<br>- 1.9.4<br>- 1.10.2<br>- 1.11.2<br>- 1.12.x<br>- 1.13.x<br>- 1.14.x<br>- 1.15.x<br>- 1.16.1-1.16.5<br>- 1.17.x<br>- 1.18.x<br>- 1.19.x<br>- 1.20-1.20.2<br>- 1.20.4 |
| fabric                      | - 1.14.x<br>- 1.15.x<br>- 1.16.x<br>- 1.17.x<br>- 1.18.x<br>- 1.19.x<br>- 1.20-1.20.4 |
| forge                       | - 1.6.1-1.6.2<br>- 1.7.2<br>- 1.7.10<br>- 1.8<br>- 1.8.8-1.8.9<br>- 1.9<br>- 1.9.4<br>- 1.10<br>- 1.10.2<br>- 1.11<br>- 1.11.2<br>- 1.12.x<br>- 1.13.2<br>- 1.14.2-1.14.4<br>- 1.15.x<br>- 1.16.1-1.16.5<br>- 1.17.1<br>- 1.18.x<br>- 1.19.x<br>- 1.20-1.20.2 |

# Environment variables
Environment variables are used to manage the server's main functions, such as RAM or enabled protocols.

Here's a table showing the key/value of each environment variable and their description

| Environment variable        | Possible value       | Default value        | Description |
|:--------------------------- |:-------------------- |:-------------------- |:----------- |
| enablequery                 | true/false           | false                | The Query protocol is a mechanism for querying a Minecraft server for information on its status, connected players, game statistics and more. It works by using specific UDP requests sent to the Minecraft server. |
| enablercon                  | true/false           | true/false           | RCON is a communication protocol for remote management and control of a Minecraft server. It offers a secure way of sending commands to the server, reading console output and even interacting with certain aspects of the server without being directly connected to it. |
| rconpassword                | true/false           | true/false           | The RCON protocol is password-protected, ensuring that only authorized users can interact with the server console. |
| enableServerPropertiesFile  | true/false           | true/false           | Bypasses other environment variables except RAM and lets the server be managed by the server.properties file. |
| xms                         | xG/xM (x is integer) | xG/xM (x is integer) | Maximum RAM used at startup
| xmx                         | xG/xM (x is integer) | xG/xM (x is integer) | Maximum RAM used during execution

### Example of a container with Environment variables
- container with only rcon and 2G RAM for startup and 4G for execution
```bash
docker run --name minecraft -it \
-p 25565:25565 -p 25575:25575 \
-e xms=2G -e xmx=4G \
-e enablercon=true -e rconpassword="test" \
thorbeorndev/minecraftserver:xx-yy
```

- container with only query
```bash
docker run --name minecraft -it \
-p 25565:25565 -p 25575:25575 \
-e enablequery=true \
thorbeorndev/minecraftserver:xx-yy
```

- container with the server.properties file manage the server configuration.
```bash
docker run --name minecraft -it \
-p 25565:25565 -p 25575:25575 \
-e enableServerPropertiesFile=true \
-v /absolute/path/to/folder:/minecraft \
thorbeorndev/minecraftserver:xx-yy
```

# Port
we can change the minecraft server's listening ports using the -p option, which allows us to remap the container's internal ports to accessible external ports. 

by default, we use :
- 25565 for query and server ports
- 25575 for the RCON port

> [!IMPORTANT]
> If the ports are changed in the server.properties file, they will have to be changed in the mapping from internal to external ports.
> example: 
> - server port is 25566
> QUERY port is 25567
> RCON port is 25568
>
> then we have : -p 25566:25566 -p 25567:25567 -p 25568:25568

# Author & Developer
### Author
- [@thorbeorndev](https://github.com/thorbeorndev)
### Developer
- [@thorbeorndev](https://github.com/thorbeorndev)

# License
[MIT](https://choosealicense.com/licenses/mit/)