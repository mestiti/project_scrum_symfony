<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200326173409 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE absence CHANGE ide_user ide_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE backlog_produit CHANGE ide_projet ide_projet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE backlog_sprint CHANGE id_equipe id_equipe INT DEFAULT NULL, CHANGE id_projet id_projet INT DEFAULT NULL, CHANGE id_sm id_sm INT DEFAULT NULL, CHANGE liste_sprint liste_sprint INT DEFAULT NULL');
        $this->addSql('ALTER TABLE calendarannuel CHANGE id_projet id_projet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conflit CHANGE id_bs id_bs INT DEFAULT NULL, CHANGE id_equipe id_equipe INT DEFAULT NULL, CHANGE id_sm id_sm INT DEFAULT NULL, CHANGE description_conflit description_conflit VARCHAR(255) DEFAULT NULL, CHANGE etat_conflit etat_conflit INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conge CHANGE ide_user ide_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE daily_meeting CHANGE ide_equipe ide_equipe INT DEFAULT NULL, CHANGE heure heure VARCHAR(50) DEFAULT NULL, CHANGE duree duree INT DEFAULT NULL, CHANGE remarque remarque VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE demande_conge CHANGE ide_user ide_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demande_projet CHANGE id_client id_client INT DEFAULT NULL');
        $this->addSql('ALTER TABLE documentation CHANGE ide_admin ide_admin INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe CHANGE ide_perso_4 ide_perso_4 INT DEFAULT NULL, CHANGE ide_scrum_master ide_scrum_master INT DEFAULT NULL, CHANGE ide_perso_1 ide_perso_1 INT DEFAULT NULL, CHANGE ide_projet ide_projet INT DEFAULT NULL, CHANGE ide_perso_5 ide_perso_5 INT DEFAULT NULL, CHANGE ide_perso_3 ide_perso_3 INT DEFAULT NULL, CHANGE ide_perso_2 ide_perso_2 INT DEFAULT NULL, CHANGE ide_perso_6 ide_perso_6 INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervention CHANGE ide_reclamation ide_reclamation INT DEFAULT NULL, CHANGE ide_sm ide_sm INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnel CHANGE id_user id_user INT DEFAULT NULL, CHANGE Specialite Specialite VARCHAR(45) DEFAULT NULL, CHANGE ide_profil ide_profil VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE po CHANGE id_user id_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projets CHANGE ide_product_owner ide_product_owner INT DEFAULT NULL, CHANGE nom_projet nom_projet VARCHAR(45) DEFAULT NULL, CHANGE date_debut_projet date_debut_projet DATE DEFAULT NULL, CHANGE date_fin_projet date_fin_projet DATE DEFAULT NULL, CHANGE etat_projet etat_projet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rconflit CHANGE id_conflit id_conflit INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE ide_personnel ide_personnel INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sm CHANGE id_user id_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sprint CHANGE id_bs id_bs INT DEFAULT NULL, CHANGE date_debut_sprint date_debut_sprint DATE DEFAULT NULL, CHANGE date_fin_sprint date_fin_sprint DATE DEFAULT NULL, CHANGE liste_user_sroty_bs liste_user_sroty_bs INT DEFAULT NULL, CHANGE description description VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE sprint_retrospective CHANGE ide_equipe ide_equipe INT DEFAULT NULL, CHANGE ide_projet ide_projet INT DEFAULT NULL, CHANGE ide_sprint ide_sprint INT DEFAULT NULL, CHANGE description_TODO description_TODO VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE sprint_review CHANGE ide_equipe ide_equipe INT DEFAULT NULL, CHANGE ide_product_owner ide_product_owner INT DEFAULT NULL, CHANGE ide_projet ide_projet INT DEFAULT NULL, CHANGE ide_sprint ide_sprint INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tableau_blanc CHANGE ide_projet ide_projet INT DEFAULT NULL, CHANGE ide_equipe ide_equipe INT DEFAULT NULL, CHANGE ide_sprint ide_sprint INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tache CHANGE ide_user_story_bs ide_user_story_bs INT DEFAULT NULL, CHANGE id_Sprint id_Sprint VARCHAR(45) DEFAULT NULL, CHANGE date_debut_tache date_debut_tache VARCHAR(50) DEFAULT NULL, CHANGE date_fin_tache date_fin_tache VARCHAR(50) DEFAULT NULL, CHANGE nom_tache nom_tache VARCHAR(45) DEFAULT NULL, CHANGE type_tache type_tache VARCHAR(45) DEFAULT NULL, CHANGE liste_Personnel liste_Personnel VARCHAR(50) DEFAULT NULL, CHANGE description_tache description_tache VARCHAR(45) DEFAULT NULL, CHANGE liste_nbre_heure liste_nbre_heure VARCHAR(45) DEFAULT NULL, CHANGE moyenne_estimation moyenne_estimation VARCHAR(45) DEFAULT NULL');
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

        $this->addSql('ALTER TABLE absence CHANGE ide_user ide_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE backlog_produit CHANGE ide_projet ide_projet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE backlog_sprint CHANGE id_equipe id_equipe INT DEFAULT NULL, CHANGE id_projet id_projet INT DEFAULT NULL, CHANGE id_sm id_sm INT DEFAULT NULL, CHANGE liste_sprint liste_sprint INT DEFAULT NULL');
        $this->addSql('ALTER TABLE calendarannuel CHANGE id_projet id_projet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conflit CHANGE id_bs id_bs INT DEFAULT NULL, CHANGE id_equipe id_equipe INT DEFAULT NULL, CHANGE id_sm id_sm INT DEFAULT NULL, CHANGE description_conflit description_conflit VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE etat_conflit etat_conflit INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conge CHANGE ide_user ide_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE daily_meeting CHANGE ide_equipe ide_equipe INT DEFAULT NULL, CHANGE heure heure VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE duree duree INT DEFAULT NULL, CHANGE remarque remarque VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE demande_conge CHANGE ide_user ide_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demande_projet CHANGE id_client id_client INT DEFAULT NULL');
        $this->addSql('ALTER TABLE documentation CHANGE ide_admin ide_admin INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe CHANGE ide_projet ide_projet INT DEFAULT NULL, CHANGE ide_scrum_master ide_scrum_master INT DEFAULT NULL, CHANGE ide_perso_1 ide_perso_1 INT DEFAULT NULL, CHANGE ide_perso_2 ide_perso_2 INT DEFAULT NULL, CHANGE ide_perso_3 ide_perso_3 INT DEFAULT NULL, CHANGE ide_perso_4 ide_perso_4 INT DEFAULT NULL, CHANGE ide_perso_5 ide_perso_5 INT DEFAULT NULL, CHANGE ide_perso_6 ide_perso_6 INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user CHANGE salt salt VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\', CHANGE date_naissance date_naissance DATE DEFAULT \'NULL\', CHANGE numero_tel numero_tel INT DEFAULT NULL, CHANGE uid uid INT DEFAULT NULL, CHANGE image_user image_user VARCHAR(1000) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE connected connected INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervention CHANGE ide_reclamation ide_reclamation INT DEFAULT NULL, CHANGE ide_sm ide_sm INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnel CHANGE id_user id_user INT DEFAULT NULL, CHANGE Specialite Specialite VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE ide_profil ide_profil VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE po CHANGE id_user id_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projets CHANGE ide_product_owner ide_product_owner INT DEFAULT NULL, CHANGE nom_projet nom_projet VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE date_debut_projet date_debut_projet DATE DEFAULT \'NULL\', CHANGE date_fin_projet date_fin_projet DATE DEFAULT \'NULL\', CHANGE etat_projet etat_projet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rconflit CHANGE id_conflit id_conflit INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE ide_personnel ide_personnel INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sm CHANGE id_user id_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sprint CHANGE id_bs id_bs INT DEFAULT NULL, CHANGE date_debut_sprint date_debut_sprint DATE DEFAULT \'NULL\', CHANGE date_fin_sprint date_fin_sprint DATE DEFAULT \'NULL\', CHANGE liste_user_sroty_bs liste_user_sroty_bs INT DEFAULT NULL, CHANGE description description VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE sprint_retrospective CHANGE ide_equipe ide_equipe INT DEFAULT NULL, CHANGE ide_projet ide_projet INT DEFAULT NULL, CHANGE ide_sprint ide_sprint INT DEFAULT NULL, CHANGE description_TODO description_TODO VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE sprint_review CHANGE ide_equipe ide_equipe INT DEFAULT NULL, CHANGE ide_product_owner ide_product_owner INT DEFAULT NULL, CHANGE ide_projet ide_projet INT DEFAULT NULL, CHANGE ide_sprint ide_sprint INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tableau_blanc CHANGE ide_projet ide_projet INT DEFAULT NULL, CHANGE ide_equipe ide_equipe INT DEFAULT NULL, CHANGE ide_sprint ide_sprint INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tache CHANGE ide_user_story_bs ide_user_story_bs INT DEFAULT NULL, CHANGE id_Sprint id_Sprint VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE date_debut_tache date_debut_tache VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE date_fin_tache date_fin_tache VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE nom_tache nom_tache VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE type_tache type_tache VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE liste_Personnel liste_Personnel VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE description_tache description_tache VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE liste_nbre_heure liste_nbre_heure VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci, CHANGE moyenne_estimation moyenne_estimation VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE user_story_backlog_produit CHANGE ide_backlog_feat ide_backlog_feat INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_story_backlog_sprint CHANGE id_sprint id_sprint INT DEFAULT NULL, CHANGE description_user_story_bs description_user_story_bs VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8_general_ci');
    }
}
