import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import { Modal } from 'flowbite';
import { format } from "date-fns";

export function initExpenseCalendar() {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    const colocationId = calendarEl.getAttribute('data-colocation');
    const totalEl = document.getElementById('month-total');
    const modalDateInput = document.getElementById('modal-date');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Initialize Flowbite Modals
    const modalEl = document.getElementById('add-expense-modal');
    const modal = modalEl ? new Modal(modalEl) : null;

    const detailModalEl = document.getElementById('expense-details-modal');
    const detailModal = detailModalEl ? new Modal(detailModalEl) : null;

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: '',
            center: 'title',
            right: ''
        },
        locale: 'fr',
        firstDay: 1,
        height: 'auto',
        events: async function (info, successCallback, failureCallback) {
            const from = format(info.startStr, 'yyyy-MM-dd');
            const to = format(info.endStr, 'yyyy-MM-dd');
            try {
                const response = await axios.get(`/expenses/${colocationId}`, {
                    params: { start: from, end: to }
                });

                if (totalEl) {
                    totalEl.innerText = `${response.data.total.toFixed(2)} DH`;
                }
                successCallback(response.data.events);
            } catch (error) {
                console.error('Error fetching expenses:', error);
                failureCallback(error);
            }
        },
        dateClick: function (info) {
            const clickedDate = format(info.dateStr, 'dd/MM/yyyy');
            const today = format(new Date(), 'dd/MM/yyyy');

            if (clickedDate > today) {
                alert("Vous ne pouvez pas créer une dépense pour une date future.");
                return;
            }

            if (modalDateInput) {
                modalDateInput.value = clickedDate;
            }

            if (modal) {
                modal.show();
            }
        },
        eventClick: function (info) {
            const expense = info.event;
            const props = expense.extendedProps;

            document.getElementById('detail-title').innerText = expense.title.split(' (')[0];
            document.getElementById('detail-amount').innerText = `${props.amount.toFixed(2)} DH`;
            document.getElementById('detail-date').innerText = format(expense.start, 'dd/MM/yyyy');
            document.getElementById('detail-payer').innerText = props.payer_name;
            document.getElementById('detail-category').innerText = props.category_name;

            if (detailModal) {
                detailModal.show();
            }
        },
        eventContent: function (arg) {
            const amount = arg.event.extendedProps.amount;
            const canDelete = arg.event.extendedProps.can_delete;

            let html = `
                <div class="fc-event-main-frame p-1 px-2 overflow-hidden text-xs rounded-lg bg-blue-50 border-l-4 border-blue-500 hover:bg-blue-100 transition-colors cursor-pointer shadow-sm">
                    <div class="fc-event-title font-bold text-blue-900 truncate">${arg.event.title.split(' (')[0]}</div>
                    <div class="flex justify-between items-center mt-0.5">
                        <span class="text-[10px] font-semibold text-blue-700">${amount.toFixed(2)} DH</span>
                        ${canDelete ? `
                            <button class="delete-expense text-red-400 hover:text-red-600 transition-colors ml-1" data-id="${arg.event.id}">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        ` : ''}
                    </div>
                </div>
            `;
            return { html: html };
        },
        eventDidMount: function (info) {
            const deleteBtn = info.el.querySelector('.delete-expense');
            if (deleteBtn) {
                deleteBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    if (confirm('Êtes-vous sûr de vouloir supprimer cette dépense ?')) {
                        const id = this.getAttribute('data-id');
                        axios.delete(`/expenses/${id}`, {
                            headers: { 'X-CSRF-TOKEN': csrfToken }
                        })
                            .then(() => {
                                calendar.refetchEvents();
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Erreur lors de la suppression.');
                            });
                    }
                });
            }
        }
    });

    calendar.render();

    document.getElementById('prev-btn')?.addEventListener('click', () => calendar.prev());
    document.getElementById('next-btn')?.addEventListener('click', () => calendar.next());
    document.getElementById('today-btn')?.addEventListener('click', () => calendar.today());

    calendar.refetchEvents();
}
