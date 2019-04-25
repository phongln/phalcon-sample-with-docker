# SAMPLE PHALCON FW APPLICATION WITH DOCKER

# Prequisites:
- PHP >= 7.3
- Docker installed
- OS: Windows / MacOS / Linux

# Install
- Edit `hosts` file for adding local domain name, example: `127.0.0.1	phalcon.local`
- Change `server_name` in `config\site.conf`
- Run command `docker-compose up -d --build`
- Go to browser, type url `http://phalcon.local/`, you will see welcome page, it's mean successful installed

# Update packages:
- After run docker with phalcon successfully, go to inside container, run `composer install` for install packages

# Credits:
- MilesChow <https://github.com/MilesChou/docker-phalcon>
- Phalcon <https://github.com/phalcon>