<!-- Contact form partial (Blade) - updated to use the secure API /api/contact. -->

<div class="contact-form">
    <!-- Prefer client-side fetch to POST JSON to /api/contact -->
    <form id="contactForm" onsubmit="return submitContact(event)">
        <label for="name">Name</label>
        <input id="name" name="name" type="text" required>

        <label for="email">Email</label>
        <input id="email" name="email" type="email" required>

        <label for="phone">Phone</label>
        <input id="phone" name="phone" type="text">

        <label for="subject">Subject</label>
        <input id="subject" name="subject" type="text">

        <label for="message">Message</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit">Send</button>
    </form>
</div>

<script>
    async function submitContact(e) {
        e.preventDefault();
        const data = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            subject: document.getElementById('subject').value,
            message: document.getElementById('message').value,
        };

        const res = await fetch('/api/contact', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data),
        });

        if (res.status === 202) {
            alert('Message queued for delivery');
        } else {
            const body = await res.json().catch(() => ({}));
            alert(body.message || 'Failed to send message');
        }
        return false;
    }
</script>