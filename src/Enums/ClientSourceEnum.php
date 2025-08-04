<?php

namespace App\Enums;

enum ClientSourceEnum: string
{
    case WEBSITE_QUOTE = 'website-quote';

    case WEBSITE_PDF = 'website-pdf';

    case WEBSITE_WEBINAR = 'website-webinar';

    case WEBSITE = 'website';

    case MANUAL = 'manual';

    case WEALTHBOX = 'wealthbox';

    case REDTAIL = 'redtail';

    case SPREADSHEET = 'spreadsheet';

    case ANNUITY_EDUCATOR = 'annuity-educator';

    public function label(): string
    {
        return match ($this) {
            self::WEBSITE_QUOTE => 'Website (Quote)',
            self::WEBSITE_PDF => 'Website (PDF)',
            self::WEBSITE => 'Website',
            self::MANUAL => 'Manual',
            self::WEALTHBOX => 'Wealthbox',
            self::REDTAIL => 'Redtail',
            self::SPREADSHEET => 'Spreadsheet',
            self::WEBSITE_WEBINAR => 'Website (Webinar)',
            self::ANNUITY_EDUCATOR => 'Annuity Educator',
        };
    }
}
