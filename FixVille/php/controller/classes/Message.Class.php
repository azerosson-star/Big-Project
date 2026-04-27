<?php
class Message
{
    private $_id_message;
    private $_id_expediteur;
    private $_id_destinataire;
    private $_content;
    private $_objet;
    private $_date_envoi;

    public function getId_message() { return $this->_id_message; }
    public function setId_message($_id_message) { $this->_id_message = $_id_message; }

    public function getId_expediteur() { return $this->_id_expediteur; }
    public function setId_expediteur($_id_expediteur) { $this->_id_expediteur = $_id_expediteur; }

    public function getId_destinataire() { return $this->_id_destinataire; }
    public function setId_destinataire($_id_destinataire) { $this->_id_destinataire = $_id_destinataire; }

    public function getContent() { return $this->_content; }
    public function setContent($_content) { $this->_content = $_content; }

    public function getObjet() { return $this->_objet; }
    public function setObjet($_objet) { $this->_objet = $_objet; }

    public function getDate_envoi() { return $this->_date_envoi; }
    public function setDate_envoi($_date_envoi) { $this->_date_envoi = $_date_envoi; }

    public function __construct(array $options = [])
    {
        if (!empty($options)) {
            $this->hydrate($options);
        }
    }

    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $methode = "set" . ucfirst($key);
            if (is_callable([$this, $methode])) {
                $this->$methode($value == "" ? null : $value);
            }
        }
    }
}