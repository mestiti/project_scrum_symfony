<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200331134226 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE personnel (id_personnel INT AUTO_INCREMENT NOT NULL, id_user INT DEFAULT NULL, Specialite VARCHAR(45) DEFAULT NULL, ide_profil VARCHAR(45) DEFAULT NULL, INDEX id_user (id_user), PRIMARY KEY(id_personnel)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE po (id_po INT AUTO_INCREMENT NOT NULL, id_user INT DEFAULT NULL, id_projet INT NOT NULL, INDEX id_user (id_user), PRIMARY KEY(id_po)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sm (id_sm INT AUTO_INCREMENT NOT NULL, id_user INT DEFAULT NULL, id_projet INT NOT NULL, INDEX id_projet (id_projet), INDEX id_user (id_user), PRIMARY KEY(id_sm)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DE6B3CA4B FOREIGN KEY (id_user) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE po ADD CONSTRAINT FK_B3EB17C06B3CA4B FOREIGN KEY (id_user) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE sm ADD CONSTRAINT FK_76C8252F6B3CA4B FOREIGN KEY (id_user) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE absence CHANGE ide_user ide_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE backlog_produit CHANGE ide_projet ide_projet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE backlog_sprint DROP FOREIGN KEY backlog_sprint_ibfk_3');
        $this->addSql('ALTER TABLE backlog_sprint CHANGE id_equipe id_equipe INT DEFAULT NULL, CHANGE id_projet id_projet INT DEFAULT NULL, CHANGE id_sm id_sm INT DEFAULT NULL, CHANGE liste_sprint liste_sprint INT DEFAULT NULL');
        $this->addSql('ALTER TABLE backlog_sprint ADD CONSTRAINT FK_5AA4F07FB6B5DC28 FOREIGN KEY (id_sm) REFERENCES sm (id_sm)');
        $this->addSql('ALTER TABLE calendarannuel CHANGE id_projet id_projet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment CHANGE post_id post_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conflit DROP FOREIGN KEY conflit_ibfk_3');
        $this->addSql('ALTER TABLE conflit CHANGE id_bs id_bs INT DEFAULT NULL, CHANGE id_equipe id_equipe INT DEFAULT NULL, CHANGE id_sm id_sm INT DEFAULT NULL, CHANGE description_conflit description_conflit VARCHAR(255) DEFAULT NULL, CHANGE etat_conflit etat_conflit INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conflit ADD CONSTRAINT FK_444502F5B6B5DC28 FOREIGN KEY (id_sm) REFERENCES sm (id_sm)');
        $this->addSql('ALTER TABLE conge CHANGE ide_user ide_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE daily_meeting CHANGE ide_equipe ide_equipe INT DEFAULT NULL, CHANGE heure heure VARCHAR(50) DEFAULT NULL, CHANGE duree duree INT DEFAULT NULL, CHANGE remarque remarque VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE demande_conge CHANGE ide_user ide_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demande_projet CHANGE id_client id_client INT DEFAULT NULL');
        $this->addSql('ALTER TABLE documentation CHANGE ide_admin ide_admin INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15133553F6');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA153695B5CF');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15635FA779');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA1563B69DEF');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA1564326360');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA158D51C655');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15FA56F6C3');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15FD3B32DA');
        $this->addSql('ALTER TABLE equipe CHANGE ide_perso_4 ide_perso_4 INT DEFAULT NULL, CHANGE ide_scrum_master ide_scrum_master INT DEFAULT NULL, CHANGE ide_perso_1 ide_perso_1 INT DEFAULT NULL, CHANGE ide_projet ide_projet INT DEFAULT NULL, CHANGE ide_perso_5 ide_perso_5 INT DEFAULT NULL, CHANGE ide_perso_3 ide_perso_3 INT DEFAULT NULL, CHANGE ide_perso_2 ide_perso_2 INT DEFAULT NULL, CHANGE ide_perso_6 ide_perso_6 INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15133553F6 FOREIGN KEY (ide_perso_4) REFERENCES personnel (id_personnel)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA153695B5CF FOREIGN KEY (ide_scrum_master) REFERENCES sm (id_sm)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15635FA779 FOREIGN KEY (ide_perso_1) REFERENCES personnel (id_personnel)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA1563B69DEF FOREIGN KEY (ide_projet) REFERENCES projets (id_projet)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA1564326360 FOREIGN KEY (ide_perso_5) REFERENCES personnel (id_personnel)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA158D51C655 FOREIGN KEY (ide_perso_3) REFERENCES personnel (id_personnel)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15FA56F6C3 FOREIGN KEY (ide_perso_2) REFERENCES personnel (id_personnel)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15FD3B32DA FOREIGN KEY (ide_perso_6) REFERENCES personnel (id_personnel)');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY intervention_ibfk_2');
        $this->addSql('ALTER TABLE intervention CHANGE ide_reclamation ide_reclamation INT DEFAULT NULL, CHANGE ide_sm ide_sm INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814ABAE8277D0 FOREIGN KEY (ide_sm) REFERENCES sm (id_sm)');
        $this->addSql('ALTER TABLE message CHANGE thread_id thread_id INT DEFAULT NULL, CHANGE sender_id sender_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message_metadata CHANGE message_id message_id INT DEFAULT NULL, CHANGE participant_id participant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE metacomment CHANGE user_id user_id INT DEFAULT NULL, CHANGE comment_id comment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE metapost CHANGE post_id post_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projets CHANGE ide_product_owner ide_product_owner INT DEFAULT NULL, CHANGE nom_projet nom_projet VARCHAR(45) DEFAULT NULL, CHANGE date_debut_projet date_debut_projet DATE DEFAULT NULL, CHANGE date_fin_projet date_fin_projet DATE DEFAULT NULL, CHANGE etat_projet etat_projet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projets ADD CONSTRAINT FK_B454C1DB57A2BCCF FOREIGN KEY (ide_product_owner) REFERENCES po (id_po)');
        $this->addSql('CREATE INDEX ide_product_owner ON projets (ide_product_owner)');
        $this->addSql('ALTER TABLE rconflit CHANGE id_conflit id_conflit INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY reclamation_ibfk_1');
        $this->addSql('ALTER TABLE reclamation CHANGE ide_personnel ide_personnel INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404846FC18C FOREIGN KEY (ide_personnel) REFERENCES personnel (id_personnel)');
        $this->addSql('ALTER TABLE sprint CHANGE id_bs id_bs INT DEFAULT NULL, CHANGE date_debut_sprint date_debut_sprint DATE DEFAULT NULL, CHANGE date_fin_sprint date_fin_sprint DATE DEFAULT NULL, CHANGE liste_user_sroty_bs liste_user_sroty_bs INT DEFAULT NULL, CHANGE description description VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE sprint_retrospective CHANGE ide_equipe ide_equipe INT DEFAULT NULL, CHANGE ide_projet ide_projet INT DEFAULT NULL, CHANGE ide_sprint ide_sprint INT DEFAULT NULL, CHANGE description_TODO description_TODO VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE sprint_review DROP FOREIGN KEY sprint_review_ibfk_2');
        $this->addSql('ALTER TABLE sprint_review CHANGE ide_equipe ide_equipe INT DEFAULT NULL, CHANGE ide_product_owner ide_product_owner INT DEFAULT NULL, CHANGE ide_projet ide_projet INT DEFAULT NULL, CHANGE ide_sprint ide_sprint INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sprint_review ADD CONSTRAINT FK_61B6FD357A2BCCF FOREIGN KEY (ide_product_owner) REFERENCES po (id_po)');
        $this->addSql('ALTER TABLE tableau_blanc CHANGE ide_projet ide_projet INT DEFAULT NULL, CHANGE ide_equipe ide_equipe INT DEFAULT NULL, CHANGE ide_sprint ide_sprint INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tache CHANGE ide_user_story_bs ide_user_story_bs INT DEFAULT NULL, CHANGE id_Sprint id_Sprint VARCHAR(45) DEFAULT NULL, CHANGE date_debut_tache date_debut_tache VARCHAR(50) DEFAULT NULL, CHANGE date_fin_tache date_fin_tache VARCHAR(50) DEFAULT NULL, CHANGE nom_tache nom_tache VARCHAR(45) DEFAULT NULL, CHANGE type_tache type_tache VARCHAR(45) DEFAULT NULL, CHANGE liste_Personnel liste_Personnel VARCHAR(50) DEFAULT NULL, CHANGE description_tache description_tache VARCHAR(45) DEFAULT NULL, CHANGE liste_nbre_heure liste_nbre_heure VARCHAR(45) DEFAULT NULL, CHANGE moyenne_estimation moyenne_estimation VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE thread CHANGE created_by_id created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE thread_metadata CHANGE participant_id participant_id INT DEFAULT NULL, CHANGE thread_id thread_id INT DEFAULT NULL, CHANGE last_participant_message_date last_participant_message_date DATETIME DEFAULT NULL, CHANGE last_message_date last_message_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL, CHANGE date_naissance date_naissance DATE DEFAULT NULL, CHANGE numero_tel numero_tel INT DEFAULT NULL, CHANGE uid uid INT DEFAULT NULL, CHANGE image_user image_user VARCHAR(1000) DEFAULT NULL, CHANGE connected connected INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_story_backlog_produit CHANGE ide_backlog_feat ide_backlog_feat INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_story_backlog_sprint CHANGE id_sprint id_sprint INT DEFAULT NULL, CHANGE description_user_story_bs description_user_story_bs VARCHAR(45) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15635FA779');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15FA56F6C3');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA158D51C655');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15133553F6');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA1564326360');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15FD3B32DA');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404846FC18C');
        $this->addSql('ALTER TABLE projets DROP FOREIGN KEY FK_B454C1DB57A2BCCF');
        $this->addSql('ALTER TABLE sprint_review DROP FOREIGN KEY FK_61B6FD357A2BCCF');
        $this->addSql('ALTER TABLE backlog_sprint DROP FOREIGN KEY FK_5AA4F07FB6B5DC28');
        $this->addSql('ALTER TABLE conflit DROP FOREIGN KEY FK_444502F5B6B5DC28');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA153695B5CF');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814ABAE8277D0');
        $this->addSql('DROP TABLE personnel');
        $this->addSql('DROP TABLE po');
        $this->addSql('DROP TABLE sm');
        $this->addSql('ALTER TABLE absence CHANGE ide_user ide_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE backlog_produit CHANGE ide_projet ide_projet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE backlog_sprint CHANGE id_equipe id_equipe INT DEFAULT NULL, CHANGE id_projet id_projet INT DEFAULT NULL, CHANGE id_sm id_sm INT DEFAULT NULL, CHANGE liste_sprint liste_sprint INT DEFAULT NULL');
        $this->addSql('ALTER TABLE backlog_sprint ADD CONSTRAINT backlog_sprint_ibfk_3 FOREIGN KEY (id_sm) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE calendarannuel CHANGE id_projet id_projet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment CHANGE user_id user_id INT DEFAULT NULL, CHANGE post_id post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conflit CHANGE id_bs id_bs INT DEFAULT NULL, CHANGE id_equipe id_equipe INT DEFAULT NULL, CHANGE id_sm id_sm INT DEFAULT NULL, CHANGE description_conflit description_conflit VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE etat_conflit etat_conflit INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conflit ADD CONSTRAINT conflit_ibfk_3 FOREIGN KEY (id_sm) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE conge CHANGE ide_user ide_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE daily_meeting CHANGE ide_equipe ide_equipe INT DEFAULT NULL, CHANGE heure heure VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE duree duree INT DEFAULT NULL, CHANGE remarque remarque VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE demande_conge CHANGE ide_user ide_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demande_projet CHANGE id_client id_client INT DEFAULT NULL');
        $this->addSql('ALTER TABLE documentation CHANGE ide_admin ide_admin INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA1563B69DEF');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA153695B5CF');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15635FA779');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15FA56F6C3');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA158D51C655');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15133553F6');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA1564326360');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15FD3B32DA');
        $this->addSql('ALTER TABLE equipe CHANGE ide_projet ide_projet INT DEFAULT NULL, CHANGE ide_scrum_master ide_scrum_master INT DEFAULT NULL, CHANGE ide_perso_1 ide_perso_1 INT DEFAULT NULL, CHANGE ide_perso_2 ide_perso_2 INT DEFAULT NULL, CHANGE ide_perso_3 ide_perso_3 INT DEFAULT NULL, CHANGE ide_perso_4 ide_perso_4 INT DEFAULT NULL, CHANGE ide_perso_5 ide_perso_5 INT DEFAULT NULL, CHANGE ide_perso_6 ide_perso_6 INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA1563B69DEF FOREIGN KEY (ide_projet) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA153695B5CF FOREIGN KEY (ide_scrum_master) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15635FA779 FOREIGN KEY (ide_perso_1) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15FA56F6C3 FOREIGN KEY (ide_perso_2) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA158D51C655 FOREIGN KEY (ide_perso_3) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15133553F6 FOREIGN KEY (ide_perso_4) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA1564326360 FOREIGN KEY (ide_perso_5) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15FD3B32DA FOREIGN KEY (ide_perso_6) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE fos_user CHANGE salt salt VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\', CHANGE date_naissance date_naissance DATE DEFAULT \'NULL\', CHANGE numero_tel numero_tel INT DEFAULT NULL, CHANGE uid uid INT DEFAULT NULL, CHANGE image_user image_user VARCHAR(1000) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE connected connected INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervention CHANGE ide_reclamation ide_reclamation INT DEFAULT NULL, CHANGE ide_sm ide_sm INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT intervention_ibfk_2 FOREIGN KEY (ide_sm) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE message CHANGE thread_id thread_id INT DEFAULT NULL, CHANGE sender_id sender_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message_metadata CHANGE message_id message_id INT DEFAULT NULL, CHANGE participant_id participant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE metacomment CHANGE user_id user_id INT DEFAULT NULL, CHANGE comment_id comment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE metapost CHANGE user_id user_id INT DEFAULT NULL, CHANGE post_id post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX ide_product_owner ON projets');
        $this->addSql('ALTER TABLE projets CHANGE ide_product_owner ide_product_owner INT DEFAULT NULL, CHANGE nom_projet nom_projet VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE date_debut_projet date_debut_projet DATE DEFAULT \'NULL\', CHANGE date_fin_projet date_fin_projet DATE DEFAULT \'NULL\', CHANGE etat_projet etat_projet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rconflit CHANGE id_conflit id_conflit INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE ide_personnel ide_personnel INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT reclamation_ibfk_1 FOREIGN KEY (ide_personnel) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE sprint CHANGE id_bs id_bs INT DEFAULT NULL, CHANGE date_debut_sprint date_debut_sprint DATE DEFAULT \'NULL\', CHANGE date_fin_sprint date_fin_sprint DATE DEFAULT \'NULL\', CHANGE liste_user_sroty_bs liste_user_sroty_bs INT DEFAULT NULL, CHANGE description description VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE sprint_retrospective CHANGE ide_equipe ide_equipe INT DEFAULT NULL, CHANGE ide_projet ide_projet INT DEFAULT NULL, CHANGE ide_sprint ide_sprint INT DEFAULT NULL, CHANGE description_TODO description_TODO VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE sprint_review CHANGE ide_equipe ide_equipe INT DEFAULT NULL, CHANGE ide_product_owner ide_product_owner INT DEFAULT NULL, CHANGE ide_projet ide_projet INT DEFAULT NULL, CHANGE ide_sprint ide_sprint INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sprint_review ADD CONSTRAINT sprint_review_ibfk_2 FOREIGN KEY (ide_product_owner) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE tableau_blanc CHANGE ide_projet ide_projet INT DEFAULT NULL, CHANGE ide_equipe ide_equipe INT DEFAULT NULL, CHANGE ide_sprint ide_sprint INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tache CHANGE ide_user_story_bs ide_user_story_bs INT DEFAULT NULL, CHANGE id_Sprint id_Sprint VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE date_debut_tache date_debut_tache VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE date_fin_tache date_fin_tache VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE nom_tache nom_tache VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE type_tache type_tache VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE liste_Personnel liste_Personnel VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE description_tache description_tache VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE liste_nbre_heure liste_nbre_heure VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE moyenne_estimation moyenne_estimation VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE thread CHANGE created_by_id created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE thread_metadata CHANGE thread_id thread_id INT DEFAULT NULL, CHANGE participant_id participant_id INT DEFAULT NULL, CHANGE last_participant_message_date last_participant_message_date DATETIME DEFAULT \'NULL\', CHANGE last_message_date last_message_date DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user_story_backlog_produit CHANGE ide_backlog_feat ide_backlog_feat INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_story_backlog_sprint CHANGE id_sprint id_sprint INT DEFAULT NULL, CHANGE description_user_story_bs description_user_story_bs VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci');
    }
}
