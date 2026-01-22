<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Project Statuses
    |--------------------------------------------------------------------------
    |
    | Available statuses for projects throughout their lifecycle
    |
    */
    'project_statuses' => [
        'demande' => 'Demande',
        'devis_envoye' => 'Devis envoyé',
        'en_attente_paiement' => 'En attente de paiement',
        'en_cours' => 'En cours',
        'en_maintenance' => 'En maintenance',
        'termine' => 'Terminé',
        'annule' => 'Annulé',
    ],

    /*
    |--------------------------------------------------------------------------
    | Payment Types
    |--------------------------------------------------------------------------
    |
    | Available payment methods
    |
    */
    'payment_types' => [
        'total' => 'Paiement total',
        'installment' => 'Paiement par tranches',
    ],

    /*
    |--------------------------------------------------------------------------
    | Payment Methods
    |--------------------------------------------------------------------------
    |
    | Supported payment gateways
    |
    */
    'payment_methods' => [
        'wave' => 'Wave',
    ],

    /*
    |--------------------------------------------------------------------------
    | Feature Types
    |--------------------------------------------------------------------------
    |
    | Types of optional features that can be added to projects
    |
    */
    'feature_types' => [
        'tracking_gps' => 'Tracking GPS en temps réel',
        'wave_integration' => 'Intégration Wave',
        'whatsapp_integration' => 'Intégration WhatsApp',
        'sms_integration' => 'Envoi de SMS',
        'email_integration' => 'Envoi d\'emails',
        'custom' => 'Fonctionnalité personnalisée',
    ],

    /*
    |--------------------------------------------------------------------------
    | Support Ticket Types
    |--------------------------------------------------------------------------
    |
    | Types of support tickets clients can create
    |
    */
    'ticket_types' => [
        'suggestion' => 'Suggestion',
        'assistance' => 'Demande d\'assistance',
        'bug' => 'Signalement de bug',
    ],

    /*
    |--------------------------------------------------------------------------
    | Support Ticket Priorities
    |--------------------------------------------------------------------------
    |
    | Priority levels for support tickets
    |
    */
    'ticket_priorities' => [
        'low' => 'Basse',
        'medium' => 'Moyenne',
        'high' => 'Haute',
        'urgent' => 'Urgente',
    ],

    /*
    |--------------------------------------------------------------------------
    | Appointment Types
    |--------------------------------------------------------------------------
    |
    | Types of appointments clients can book
    |
    */
    'appointment_types' => [
        'maintenance' => 'Maintenance',
        'support' => 'Support technique',
        'evolution' => 'Évolution du projet',
        'consultation' => 'Consultation',
    ],

    /*
    |--------------------------------------------------------------------------
    | Notification Channels
    |--------------------------------------------------------------------------
    |
    | Available notification channels
    |
    */
    'notification_channels' => [
        'email' => true,
        'whatsapp' => env('WHATSAPP_ENABLED', false),
        'sms' => env('SMS_ENABLED', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Currency
    |--------------------------------------------------------------------------
    |
    | Default currency for the platform
    |
    */
    'currency' => [
        'code' => 'XOF',
        'symbol' => 'FCFA',
        'position' => 'after', // before or after
    ],

    /*
    |--------------------------------------------------------------------------
    | Quote Settings
    |--------------------------------------------------------------------------
    |
    | Settings for quote generation
    |
    */
    'quote' => [
        'prefix' => 'DEV',
        'validity_days' => 30,
    ],

    /*
    |--------------------------------------------------------------------------
    | Invoice Settings
    |--------------------------------------------------------------------------
    |
    | Settings for invoice generation
    |
    */
    'invoice' => [
        'prefix' => 'FACT',
    ],

    /*
    |--------------------------------------------------------------------------
    | Company Information
    |--------------------------------------------------------------------------
    |
    | Default company information for documents
    |
    */
    'company' => [
        'name' => env('COMPANY_NAME', 'Code Craft'),
        'address' => env('COMPANY_ADDRESS', ''),
        'phone' => env('COMPANY_PHONE', ''),
        'email' => env('COMPANY_EMAIL', 'contact@codecraft.com'),
        'website' => env('COMPANY_WEBSITE', 'https://codecraft.com'),
        'logo' => env('COMPANY_LOGO', null),
    ],
];
