# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
    config.vm.box = "bento/centos-7"
    config.vm.network "private_network", ip: "214.152.240.51"
    config.vm.synced_folder "../clig", "/var/www/html/clig/"
    config.vm.synced_folder "/base/scripts/", "/base/scripts/"

    config.vm.provider "virtualbox" do |vb|
        vb.gui = false
        vb.memory = "1024"
    end

    config.vm.provision "shell", inline: <<-SHELL
        sudo yum update -y

        yum install -y httpd php apache2


        #######################
        # Setup Virtual Hosts #
        #######################
        sudo mkdir -p /etc/httpd/sites-available /etc/httpd/sites-enabled /var/www/html/clig/logs/

        cat >> /etc/httpd/conf.d/local.clig.com.conf <<EOF
# CUSTOM DOC ROOT
<VirtualHost *:80>
    ServerName local.clig.com
    ServerAlias local.clig.com
    DocumentRoot /var/www/html/clig/public

    <Directory "/var/www/html/clig/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog /var/www/html/clig/logs/error.log
    CustomLog /var/www/html/clig/logs/requests.log combined
</VirtualHost>

IncludeOptional sites-enabled/*.conf
ServerName 214.152.240.51
EOF

    SHELL
end
