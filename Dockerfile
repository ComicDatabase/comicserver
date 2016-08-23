FROM million12/php-app-ssh

RUN apt update
RUN apt install -y vim git wget curl tmux fish
RUN git config --global user.email "admin@comicdatabase.com"
RUN git config --global user.name "Comic DataBase"
RUN apt install -y php-curl
ADD info.php /var/www/html/
RUN echo 'root:root' | chpasswd
RUN chsh -s $(which fish)
RUN sed -ri 's/^PermitRootLogin\s+.*/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -ri 's/UsePAM yes/#UsePAM yes/g' /etc/ssh/sshd_config

EXPOSE 22 80 8000 8080


