<?php

$contact=<<<HTML
        <h1 class="mb-1">Contact</h1>
        <form class="bg-white p-2 br-1 shadow flex flex-col gap-1" method="POST" action="index.php?page=ContactAction">
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input" placeholder="nom@domaine.com" required name="email">
            </div>
            <div class="form-group">
                <label class="form-label">Message</label>
                <textarea class="form-input" required name="message" rows="5"></textarea>
            </div>
            <button type="submit" class="btn bg-primary br-1">Envoyer</button>
        </form>
HTML;

echo $contact;