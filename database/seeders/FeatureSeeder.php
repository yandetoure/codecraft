<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        $features = array_merge(
            $this->getTechnicalFeatures(),
            $this->getMarketingFeatures(),
            $this->getSupportFeatures(),
            $this->getEcommerceFeatures(),
            $this->getHealthFeatures(),
            $this->getDeliveryFeatures(),
            $this->getShowcaseFeatures(),
            $this->getHotelFeatures(),
            $this->getStockFeatures(),
            $this->getTransportFeatures(),
            $this->getCulinaryFeatures(),
            $this->getRealEstateFeatures()
        );

        foreach ($features as $data) {
            $data['slug'] = Str::slug($data['name']);
            // Verify if description is set, else add default
            if (!isset($data['description'])) {
                $data['description'] = 'Module professionnel optimisé pour votre secteur d\'activité.';
            }

            Feature::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }

    private function getTechnicalFeatures()
    {
        return [
            ['name' => 'Authentification 2FA', 'type' => 'technical', 'price' => 150000, 'icon' => '🔐', 'description' => 'Sécurisez les comptes avec double authentification.'],
            ['name' => 'Protection Anti-DDoS', 'type' => 'technical', 'price' => 250000, 'icon' => '🛡️'],
            ['name' => 'Certificat SSL EV', 'type' => 'technical', 'price' => 80000, 'icon' => '🔒'],
            ['name' => 'Audit de Sécurité', 'type' => 'technical', 'price' => 300000, 'icon' => '🕵️'],
            ['name' => 'Connexion Sociale', 'type' => 'technical', 'price' => 85000, 'icon' => '🌐'],
            ['name' => 'Mise en Cache Redis', 'type' => 'technical', 'price' => 120000, 'icon' => '⚡'],
            ['name' => 'Architecture Microservices', 'type' => 'technical', 'price' => 500000, 'icon' => '🏗️'],
            ['name' => 'API RESTful Complète', 'type' => 'technical', 'price' => 300000, 'icon' => '🔌'],
            ['name' => 'PWA (Progressive Web App)', 'type' => 'technical', 'price' => 200000, 'icon' => '📱'],
            ['name' => 'Mode Sombre', 'type' => 'technical', 'price' => 75000, 'icon' => '🌑'],
        ];
    }

    private function getMarketingFeatures()
    {
        return [
            ['name' => 'SEO Audit Avancé', 'type' => 'marketing', 'price' => 150000, 'icon' => '🕵️‍♂️'],
            ['name' => 'Campagne Google Ads', 'type' => 'marketing', 'price' => 200000, 'icon' => '🔎'],
            ['name' => 'Pixel Meta / Facebook', 'type' => 'marketing', 'price' => 40000, 'icon' => '🟦'],
            ['name' => 'Emailing Automatisé', 'type' => 'marketing', 'price' => 120000, 'icon' => '📨'],
            ['name' => 'Community Management', 'type' => 'marketing', 'price' => 300000, 'icon' => '🗣️'],
        ];
    }

    private function getSupportFeatures()
    {
        return [
            ['name' => 'Maintenance 24/7', 'type' => 'support', 'price' => 100000, 'icon' => '🛡️'],
            ['name' => 'Formation Équipe', 'type' => 'support', 'price' => 200000, 'icon' => '🎓'],
            ['name' => 'Support Prioritaire', 'type' => 'support', 'price' => 300000, 'icon' => '🚨'],
        ];
    }

    private function getEcommerceFeatures()
    {
        // 100+ E-commerce features
        $list = [];
        $items = [
            'Panier Abandonné',
            'Comparateur Produits',
            'Wishlist',
            'Zoom Produit HD',
            'Vente Flash Compteur',
            'Cross-selling Auto',
            'Up-selling Panier',
            'Codes Promo Avancés',
            'Cartes Cadeaux',
            'Programme Fidélité',
            'Avis Clients Vérifiés',
            'Questions / Réponses',
            'Multi-Devises',
            'Calcul Taxe Auto',
            'Frais Port Dynamiques',
            'Click & Collect',
            'Livraison Express',
            'Points Relais',
            'Suivi Colis Temps Réel',
            'Retours Facilités',
            'Facturation PDF Auto',
            'Synchro Stock Magasin',
            'Marketplace Multi-vendeurs',
            'Enchères en Ligne',
            'Abonnement Produits',
            'Pack Produits',
            'Produits Configurables',
            'Produits Virtuels',
            'Précommande',
            'Alerte Stock',
            'B2B Prix Spécifiques',
            'Demande de Devis',
            'Catalogue Mode Catalogue',
            'Filtres à Facettes',
            'Recherche Intelligente',
            'Recherche Vocale',
            'Scan Code Barre',
            'Paiement en 3x',
            'Paiement Crypto',
            'Wallet Virtuel',
            'Social Selling',
            'Instagram Shop',
            'Facebook Catalog',
            'Google Shopping Feed',
            'Amazon Connector',
            'Dropshipping Module',
            'Affiliation System',
            'Parrainage Clients',
            'Blog E-commerce',
            'Live Shopping',
            'Essayage Virtuel AR',
            'Personnalisation Produit',
            'Gravure Laser Preview',
            'Calculateur Surface',
            'Vente Privée',
            'Compte Invité',
            'One Page Checkout',
            'Login Social',
            'Re-commande en 1 clic',
            'Historique Commandes',
            'Carnet 1000 Adresses',
            'Gestion SAV',
            'Remboursement Auto',
            'avoirs PDF',
            'TVA Intracommunautaire',
            'GeoIP Direction',
            'Traduction Auto',
            'Support Chatbot Vente',
            'Recommendation IA',
            'Statistiques Ventes',
            'Export Comptable',
            'Synchro ERP',
            'Connexion CRM',
            'PIM Integration',
            'Gestion Fournisseurs',
            'Dropshipping AliExpress',
            'Print on Demand',
            'Calcul Marge Nette',
            'Objectifs Vente',
            'Badges Produits (Nouveau)',
            'Popup Newsletter',
            'Roue de la Fortune',
            'Barre Livraison Gratuite',
            'Notification Stock',
            'Comparateur Prix',
            'Gestion Marques',
            'Gestion Attributs',
            'Import CSV Massif',
            'API E-commerce',
            'Headless Commerce'
        ];

        foreach ($items as $item) {
            $list[] = ['name' => $item, 'type' => 'ecommerce', 'price' => rand(50000, 300000), 'icon' => '🛍️'];
        }
        return $list;
    }

    private function getHealthFeatures()
    {
        // 100+ Health features
        $list = [];
        $items = [
            'Prise RDV en Ligne',
            'Dossier Médical Partagé',
            'Téléconsultation Vidéo',
            'Ordonnance Électronique',
            'Gestion Salle Attente',
            'Rappel SMS RDV',
            'Facturation Sécu',
            'Carte Vitale Lecteur',
            'Suivi Constantes',
            'Courbes Croissance',
            'Gestion Lits Hôpital',
            'Planning Gardes',
            'Messagerie Sécurisée',
            'Synchro Labo Analyse',
            'Prescription Assistée',
            'Vidal Intégré',
            'Dossier Dentaire',
            'Schéma Dentaire 3D',
            'Suivi Grossesse',
            'Calculateur IMC',
            'Gestion Vaccins',
            'Alerte Allergies',
            'Interactions Médicament',
            'Gestion Stock Pharma',
            'Commande Grossiste',
            'Scanner Code Datamatrix',
            'Feuille de Soins',
            'Tiers Payant',
            'Compta Médecin',
            'Statistiques Patientèle',
            'Site Web Cabinet',
            'Portail Patient',
            'Résultats en Ligne',
            'Pré-admission Hôpital',
            'Consentement Électronique',
            'Questionnaire Pré-Op',
            'Suivi Post-Op',
            'Carnet Vaccination',
            'Gestion Ambulance',
            'Planning Bloc Opératoire',
            'Stérilisation Traçabilité',
            'Maintenance Bio-médicale',
            'Gestion Déchets DASRI',
            'Réseau de Soins',
            'Adressage Confrère',
            'Annuaire Professionnels',
            'Géolocalisation Urgence',
            'Bouton Panique App',
            'Suivi Diabète',
            'Suivi Cardiaque',
            'Montre Connectée Link',
            'Analyse Sommeil',
            'Régime Alimentaire',
            'Planning Soins Infirmiers',
            'Tournée Infirmière',
            'Transmission Ciblée',
            'Constantes Vitales Mobile',
            'Dictée Vocale Médicale',
            'Compte Rendu Auto',
            'Intégration HPRIM',
            'Connecteur DMP',
            'Messagerie MSSanté',
            'Sécurisation HDS',
            'Audit Accès Données',
            'Anonymisation Données',
            'Recherche Clinique',
            'Cohorte Patients',
            'Gestion Essais Cliniques',
            'Pharmacovigilance',
            'Matériovigilance',
            'Gestion EHPAD',
            'Projet de Vie',
            'Suivi Girage',
            'Plan de Soins',
            'Distribution Médicaments',
            'Planning Repas',
            'Gestion Buanderie',
            'Facturation Hébergement',
            'Lien Famille App',
            'Animation Sociale',
            'Psychologue Suivi',
            'Ergothérapeute Suivi',
            'Kiné Suivi',
            'Orthophoniste Suivi',
            'Psychomotricien Suivi'
        ];

        foreach ($items as $item) {
            $list[] = ['name' => $item, 'type' => 'health', 'price' => rand(100000, 500000), 'icon' => '🏥'];
        }
        return $list;
    }

    private function getDeliveryFeatures()
    {
        // 50+ Delivery features
        $list = [];
        $items = [
            'Calcul Itinéraire Opti',
            'Dispatch Automatique',
            'App Livreur Mobile',
            'Preuve Livraison Photo',
            'Signature Électronique',
            'Suivi Live Carte',
            'Notification Client SMS',
            'Estimation Heure Arrivée',
            'Gestion Flotte Scooters',
            'Entretien Véhicules',
            'Gestion Carburant',
            'Attribution Zones',
            'Tarification KM',
            'Tarification Poids',
            'Gestion retours Colis',
            'Scan Code Barre Colis',
            'Bordereau Livraison',
            'Facturation Mensuelle',
            'API E-commerçants',
            'Intégration Shopify',
            'Intégration WooCommerce',
            'Gestion Entrepôt',
            'Tri Automatique',
            'Etiquetage QR Code',
            'Alertes Retard',
            'Chat Dispatch-Livreur',
            'Pourboire en Ligne',
            'Historique Trajets',
            'Analyse Rentabilité',
            'Calcul CO2',
            'Gestion Tournées',
            'Livraison Dernier KM',
            'Click & Collect',
            'Livraison Express',
            'Livraison Programmée',
            'Gestion Casiers',
            'Relais Colis',
            'Assurance Colis',
            'Litiges Livraison',
            'Remboursement Auto',
            'Livreur Indépendant',
            'Paie Livreur',
            'Score Performance',
            'Prime Livreur',
            'Gamification Livreurs',
            'Mode Hors Ligne App',
            'Navigation GPS Waze',
            'Appel Masqué',
            'Numérisation Documents',
            'Carte Chaleur Commandes'
        ];

        foreach ($items as $item) {
            $list[] = ['name' => $item, 'type' => 'delivery', 'price' => rand(80000, 250000), 'icon' => '🚚'];
        }
        return $list;
    }

    private function getShowcaseFeatures()
    {
        // 20+ Showcase features
        $list = [];
        $items = [
            'Design Responsive',
            'Formulaire Contact',
            'Galerie Photo',
            'Slider Home',
            'Témoignages Clients',
            'Google Maps',
            'Lien Réseaux Sociaux',
            'Blog Actualités',
            'Newsletter Signup',
            'Présentation Équipe',
            'Historique Entreprise',
            'Valeurs & Mission',
            'Partenaires Logos',
            'FAQ Dynamique',
            'Chat Widget',
            'Multilangue',
            'Statistiques Visites',
            'Maintenance Contenu',
            'Hébergement Inclus',
            'Nom de Domaine',
            'Certificat SSL',
            'Optimisation SEO',
            'Vitesse Chargement',
            'Accessibilité RGAA',
            'Mentions Légales'
        ];

        foreach ($items as $item) {
            $list[] = ['name' => $item, 'type' => 'showcase', 'price' => rand(50000, 150000), 'icon' => '🌐'];
        }
        return $list;
    }

    private function getHotelFeatures()
    {
        // 50+ Hotel features
        $list = [];
        $items = [
            'Moteur Réservation',
            'Channel Manager',
            'Calendrier Dispo',
            'Gestion Chambres',
            'Check-in en Ligne',
            'Clé Mobile (NFC)',
            'Facturation Séjour',
            'Taxe Séjour Auto',
            'Gestion Ménage',
            'Etat des Lieux App',
            'Room Service App',
            'Conciergerie Digitale',
            'Réservation Spa',
            'Réservation Restaurant',
            'Gestion Stocks Minibar',
            'Maintenance Chambres',
            'Objets Trouvés',
            'Fidélité Client',
            'Emailing Pré-séjour',
            'Enquête Satisfaction',
            'Gestion Tarifs Yield',
            'Offres Spéciales',
            'Codes Promo',
            'Connexion Booking.com',
            'Connexion Expedia',
            'Intégration Airbnb',
            'PMS Cloud',
            'Tableau Bord TO',
            'Gestion Groupes',
            'Séminaires & Banquets',
            'Planning Salles',
            'Devis Evénement',
            'Facture Proforma',
            'Caution en Ligne',
            'Paiement TPE Virtuel',
            'Scanner Passeport',
            'Fiche Police',
            'Statistiques Taux Occup',
            'RevPAR Calcul',
            'Analyse Concurrence',
            'Gestion Personnel',
            'Planning Équipe',
            'Pointage Heures',
            'Caisse Bar/Resto',
            'Transfert Aéroport',
            'Guide Touristique',
            'Météo Locale',
            'Réveil Automatique',
            'TV Connectée',
            'Wifi Portail Captif'
        ];

        foreach ($items as $item) {
            $list[] = ['name' => $item, 'type' => 'hotel', 'price' => rand(150000, 600000), 'icon' => '🏨'];
        }
        return $list;
    }

    private function getStockFeatures()
    {
        // 50+ Stock features
        $list = [];
        $items = [
            'Scan Code Barre',
            'Inventaire Tournant',
            'Alerte Rupture',
            'Calcul Rotation Stock',
            'Valorisation Stock (PMP)',
            'Entrée de Stock',
            'Sortie de Stock',
            'Bon de Livraison',
            'Bon de Réception',
            'Gestion Fournisseurs',
            'Commande Achat',
            'Réappro Automatique',
            'Gestion Dépôts Multi',
            'Transfert Inter-dépôt',
            'Traçabilité Lots',
            'Gestion Dates Péremption',
            'Gestion Numéros Série',
            'Etiquettes Code Barre',
            'Impression Etiquettes',
            'App Douchette Mobile',
            'Kitting / Assemblage',
            'Désassemblage',
            'Gestion Variantes',
            'Unités de Mesure',
            'Conversion Unités',
            'Stock Minimum/Max',
            'Emplacement Rayonnage',
            'Carte Entrepôt 3D',
            'Optimisation Picking',
            'Colisage',
            'Calcul Poids/Volume',
            'Frais Douane',
            'Devise Achat',
            'Historique Mouvements',
            'Justification écarts',
            'Inventaire Fiscal',
            'Export Excel Stock',
            'API Stock Temps Réel',
            'Synchro Site E-commerce',
            'Synchro Caisse',
            'Gestion Consommables',
            'Gestion Outils',
            'Prêt Matériel',
            'Retour Matériel',
            'Maintenance Matériel',
            'Amortissement',
            'Gestion Déchets',
            'Stock Alerte Email',
            'Dashboard Rotation',
            'Prévisionnel Stock'
        ];

        foreach ($items as $item) {
            $list[] = ['name' => $item, 'type' => 'stock', 'price' => rand(100000, 400000), 'icon' => '📦'];
        }
        return $list;
    }

    private function getTransportFeatures()
    {
        // 50+ Transport features
        $list = [];
        $items = [
            'Gestion Flotte Véhicules',
            'Entretien Véhicules',
            'Suivi Contrôle Technique',
            'Suivi Assurance',
            'Gestion Cartes Carburant',
            'Analyse Consommation',
            'Géolocalisation Flotte',
            'Eco-Conduite Score',
            'Planning Chauffeurs',
            'Gestion Temps Conduite',
            'Respect RSE',
            'Lecture Tachygraphe',
            'Feuille de Route',
            'Ordre de Transport',
            'Lettre de Voiture',
            'CMR Électronique',
            'Facturation Transport',
            'Calcul Marge Transport',
            'Bourse de Fret',
            'App Chauffeur',
            'Preuve Livraison',
            'Scan Palettes',
            'Gestion Litiges Transport',
            'Suivi Incidents',
            'Constat Amiable App',
            'Calcul Coût Revient',
            'Rentabilité par Camion',
            'Gestion Pneus',
            'Gestion Péages',
            'Télépéage Auto',
            'Planning Absences',
            'Formation FCO',
            'Permis de Conduire',
            'Visite Médicale',
            'EPI Gestion',
            'Alertes Maintenance',
            'Garage Interne',
            'Stock Pièces Détachées',
            'Lavage Véhicule',
            'Contrat Location',
            'Affrètement',
            'Sous-traitance',
            'Portail Client Transport',
            'Track & Trace',
            'EDI Transporteur',
            'Optimisation Tournées',
            'Calcul Itinéraire PL',
            'Restrictions Poids Lourds',
            'Taxe à l\'essieu',
            'Bilan Carbone'
        ];

        foreach ($items as $item) {
            $list[] = ['name' => $item, 'type' => 'transport', 'price' => rand(200000, 800000), 'icon' => '🚛'];
        }
        return $list;
    }

    private function getCulinaryFeatures()
    {
        // Culinary features
        $list = [];
        $items = [
            'Menu QR Code',
            'Borne de Commande',
            'Click & Collect',
            'Réservation de Table',
            'Plan de Salle 3D',
            'KDS (Kitchen Display System)',
            'Fiches Techniques Recettes',
            'Calcul Coût Matière',
            'Gestion Allergènes',
            'HACCP Digital',
            'Traçabilité Alimentaire',
            'Relevé Température Auto',
            'Etiquetage DLC',
            'Gestion Gaspillage',
            'Inventaire Boissons',
            'Connexion UberEats/Deliveroo',
            'Impression Cuisine',
            'Menu Digital Tablette',
            'Sommelier Virtuel',
            'Accords Mets-Vins',
            'Gestion Pourboires Tips',
            'Partage Addition',
            ' Paiement à Table',
            'Ticket Restaurant Digital',
            'Caisse Tactile iPad',
            'Statistiques Service',
            'Planning Cuisine',
            'Planning Salle',
            'Gestion Extras',
            'Formation Hygiène',
            'Commande Fournisseur',
            'Réception Marchandise',
            'Comparateur Prix Ingrédients',
            'Inventaire Flash',
            'Rotation Stock FIFO',
            'Programme Fidélité Resto',
            'Campagne SMS Midi',
            'Avis Clients Google',
            'Site Web Restaurant',
            'Module Traiteur',
            'Devis Banquets',
            'Gestion Mariages',
            'Facturation Entreprises',
            'Carte des Vins iPads',
            'Ecran Appel Client'
        ];

        foreach ($items as $item) {
            $list[] = ['name' => $item, 'type' => 'culinary', 'price' => rand(80000, 400000), 'icon' => '🍳'];
        }
        return $list;
    }

    private function getRealEstateFeatures()
    {
        // Real Estate features
        $list = [];
        $items = [
            'Gestion Locative',
            'Syndic Copropriété',
            'Rapprochement Bancaire',
            'Quittancement Auto',
            'Révision Loyer',
            'Régularisation Charges',
            'Etat des Lieux Tablette',
            'Signature Bail Électronique',
            'Dossier Locataire Numérique',
            'Scoring Solvabilité',
            'Espace Locataire',
            'Espace Propriétaire',
            'Gestion Tickets Incidents',
            'Suivi Travaux',
            'Carnet Entretien Immeuble',
            'Assemblée Générale Vote',
            'Visio AG',
            'Compte Bancaire Séparé',
            'Facturation Honoraires',
            'Déclaration Revenus Foncier',
            'CRM Agent Immobilier',
            'Pigé Immobilière',
            'Estimation Bien en Ligne',
            'Annonces Multi-diffusion',
            'Passerelle SeLoger/Leboncoin',
            'Visite Virtuelle 360',
            'Plan 2D/3D',
            'Home Staging Virtuel',
            'Registre des Mandats',
            'Compromis de Vente',
            'Suivi Notaire',
            'Simulateur Prêt Immo',
            'Calcul Rentabilité Locative',
            'Carte Prix Marché',
            'Alertes Nouveaux Biens',
            'Gestion Clés',
            'Panneaux Connectés',
            'Fiche Vitrine QR',
            'Automobilité Agent',
            'Statistiques Ventes',
            'Gestion Prospection',
            'Boitage Géolocalisé',
            'Emailing Acquéreurs',
            'Agenda Partagé Visites',
            'Feedback Visites'
        ];

        foreach ($items as $item) {
            $list[] = ['name' => $item, 'type' => 'real_estate', 'price' => rand(150000, 600000), 'icon' => '🏠'];
        }
        return $list;
    }
}
