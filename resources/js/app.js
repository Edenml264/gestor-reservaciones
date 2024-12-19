import './bootstrap';
import 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
import { Spanish } from 'flatpickr/dist/l10n/es.js';

import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()

// Configuración global de Flatpickr
document.addEventListener('livewire:navigated', () => {
    flatpickr("[wire\\:model\\.live='dateRange']", {
        mode: "range",
        dateFormat: "Y-m-d",
        locale: Spanish,
        defaultDate: [new Date(), new Date()],
        allowInput: true,
        showMonths: 2,
    });
});
