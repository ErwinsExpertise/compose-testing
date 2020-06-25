# Use base Linuxserver Wireshark as base image
FROM linuxserver/wireshark
# Update and upgrade all repos and dependencies
RUN apt-get update -y
RUN apt-get upgrade -y
# Install FireFox
RUN apt-key adv --keyserver keyserver.ubuntu.com --recv-keys A6DCF7707EBC211F
RUN apt-add-repository "deb http://ppa.launchpad.net/ubuntu-mozilla-security/ppa/ubuntu bionic main"
RUN apt-get update
RUN apt-get install -y firefox