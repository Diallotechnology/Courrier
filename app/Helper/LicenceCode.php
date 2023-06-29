<?php
namespace App\Helper;

trait LicenceCode
{
    // fonction pour générer un code de licence unique
    protected function generateLicenseCode($length = 32): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $licenseCode = '';
        $characterCount = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $licenseCode .= $characters[rand(0, $characterCount - 1)];
        }

        return $licenseCode;
    }
}
