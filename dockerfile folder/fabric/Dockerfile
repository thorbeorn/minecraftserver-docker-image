FROM debian:bookworm-slim

ENV xms="1G"
ENV xmx="2G"
ENV enablequery="false"
ENV enablercon="false"
ENV enableServerPropertiesFile="false"
ENV rconpassword=""

RUN apt update -y
RUN apt install -y screen openjdk-17-jdk-headless

RUN mkdir /minecraft
WORKDIR /minecraft

COPY fabric/fabric-server-mc.1.14.1-loader.0.15.1-launcher.0.11.2.jar /server.jar

COPY entrypoint.sh /entrypoint.sh
RUN chmod a+x /entrypoint.sh

EXPOSE 25565 25575

ENTRYPOINT ["/entrypoint.sh"]