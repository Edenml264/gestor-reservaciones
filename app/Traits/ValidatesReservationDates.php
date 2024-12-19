<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Validation\Validator;

trait ValidatesReservationDates
{
    /**
     * Reglas de validación para fechas de reservación
     */
    protected function getDateValidationRules(): array
    {
        $today = Carbon::today()->format('Y-m-d');
        $maxDate = Carbon::today()->addYear()->format('Y-m-d');

        return [
            'arrival_date' => [
                'required',
                'date',
                'after_or_equal:' . $today,
                'before_or_equal:' . $maxDate,
            ],
            'departure_date' => [
                'required_if:service_type,round-trip',
                'date',
                'after_or_equal:arrival_date',
                'before_or_equal:' . $maxDate,
            ],
            'pickup_date' => [
                'required',
                'date',
                'after_or_equal:' . $today,
                'before_or_equal:' . $maxDate,
            ],
        ];
    }

    /**
     * Reglas de validación para horas de reservación
     */
    protected function getTimeValidationRules(): array
    {
        return [
            'arrival_time' => ['required', 'date_format:H:i'],
            'departure_time' => ['required_if:service_type,round-trip', 'date_format:H:i'],
            'pickup_time' => ['required', 'date_format:H:i'],
        ];
    }

    /**
     * Mensajes personalizados para la validación de fechas
     */
    protected function getDateValidationMessages(): array
    {
        return [
            'arrival_date.after_or_equal' => 'La fecha de llegada debe ser igual o posterior a hoy.',
            'arrival_date.before_or_equal' => 'La fecha de llegada no puede ser más de un año en el futuro.',
            'departure_date.after_or_equal' => 'La fecha de salida debe ser igual o posterior a la fecha de llegada.',
            'departure_date.before_or_equal' => 'La fecha de salida no puede ser más de un año en el futuro.',
            'pickup_date.after_or_equal' => 'La fecha de recogida debe ser igual o posterior a hoy.',
            'pickup_date.before_or_equal' => 'La fecha de recogida no puede ser más de un año en el futuro.',
            'arrival_time.date_format' => 'El formato de la hora de llegada no es válido.',
            'departure_time.date_format' => 'El formato de la hora de salida no es válido.',
            'pickup_time.date_format' => 'El formato de la hora de recogida no es válido.',
        ];
    }

    /**
     * Valida que la hora de recogida sea válida según la fecha
     */
    protected function validatePickupTime($validator)
    {
        $pickupDate = Carbon::parse($this->pickup_date);
        $pickupTime = Carbon::parse($this->pickup_time);
        $now = Carbon::now();

        if ($pickupDate->isToday() && $pickupTime->isBefore($now)) {
            $validator->errors()->add(
                'pickup_time',
                'La hora de recogida debe ser posterior a la hora actual.'
            );
        }
    }

    /**
     * Valida que haya suficiente tiempo entre la llegada y la recogida
     */
    protected function validateTimeBetweenFlights($validator)
    {
        if ($this->service_type === 'round-trip') {
            $arrivalDateTime = Carbon::parse($this->arrival_date . ' ' . $this->arrival_time);
            $departureDateTime = Carbon::parse($this->departure_date . ' ' . $this->departure_time);

            $minHours = 2;
            if ($departureDateTime->diffInHours($arrivalDateTime) < $minHours) {
                $validator->errors()->add(
                    'departure_time',
                    "Debe haber al menos {$minHours} horas entre la llegada y la salida."
                );
            }
        }
    }
}
