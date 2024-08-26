

sudo mysql


CREATE USER 'mon_utilisateur'@'localhost' IDENTIFIED BY 'mon_mot_de_passe';


GRANT privilèges ON base_de_données.* TO 'nom_utilisateur'@'localhost';


GRANT ALL PRIVILEGES ON ma_base.* TO 'mon_utilisateur'@'localhost';

FLUSH PRIVILEGES;
