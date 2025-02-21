<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class BookingsExport implements FromCollection, WithHeadings, WithCustomCsvSettings
{
    public function collection()
    {
        return Booking::with(['hotel', 'tour'])
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'tour' => $this->sanitizeText($booking->tour->name ?? 'N/A'),
                    'hotel' => $this->sanitizeText($booking->hotel->name ?? 'N/A'),
                    'customer_name' => $this->sanitizeText($booking->customer_name),
                    'customer_email' => $booking->customer_email,
                    'number_of_people' => $booking->number_of_people,
                    'booking_date' => $booking->booking_date,
                ];
            });
    }

    public function headings(): array
    {
        return ['ID', 'TOUR', 'HOTEL', 'CUSTOMER NAME', 'CUSTOMER EMAIL', 'NUMBER OF PEOPLE', 'BOOKING DATE'];
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ',',
            'enclosure' => '',
            'input_encoding' => 'UTF-8',
            'output_encoding' => 'UTF-8',
        ];
    }

    private function sanitizeText($text)
    {
        return preg_replace('/[^\PC\s]/u', '', $text);
    }
}
