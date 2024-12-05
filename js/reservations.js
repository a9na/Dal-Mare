class Reservation {
    constructor(beginDate, endDate) {
        if (new Date(endDate) < new Date(beginDate)) {
            throw new Error("End date cannot be before the begin date.");
        }

        this.beginDate = new Date(beginDate);
        this.endDate = new Date(endDate);
    }

    getBetweenDays() {
        var currentDate = new Date(this.beginDate);
        const dates = [];

        while (currentDate <= this.endDate) {
            dates.push(new Date(currentDate));
            currentDate.setDate(currentDate.getDate() + 1);
        }

        return dates;
    }
}

function generateReservedDates(reservations) {
    const dates = [];
    reservations.forEach(reservation => {
        const reservationDates = reservation.getBetweenDays();
        dates.push(...reservationDates);
    });
    return dates;
}

function isDateInArray(date, dateArray) {
    return dateArray.some(d => d.getTime() === date.getTime());
}

async function reserve(startDate, endDate, apartment_id, user_id) {
    const reservation = new Reservation(startDate, endDate);
    const reservationDates = reservation.getBetweenDays();

    const reservedDates = await fetchReservedDates(apartment_id);
    
    for (let date of reservationDates) {
        if (isDateInArray(date, reservedDates)) {
            throw new Error("Your reservation overlaps reserved dates. Please choose other dates.");
        }
    }

    const response = await fetch('createReservation.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ apartment_id, user_id, begin_date: startDate, end_date: endDate })
    });
    const result = await response.json();

    if (result.status === "success") {
        alert("Reservation successfully submitted!");
    } else {
        throw new Error("Failed to create reservation.");
    }
}
