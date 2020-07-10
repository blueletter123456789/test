<div id="form-wrapper">
  <form method="POST" action="./form/mail_check.php">
    <div id="form-inside">
      <div class="name-record">
        <p class="input-record" id="input-firstname">
          <span class="form-tag">First Name</span>
          <input class="input-val" type="text" name="firstname" required/>
        </p>
        <p class="input-record" id="input-lastname">
          <span class="form-tag">Last Name</span>
          <input class="input-val" type="text" name="lastname" required/>
        </p>
      </div>
      <p class="input-record" id="input-mail">
        <span class="form-tag">Mail</span>
        <input class="input-val" type="email" name="mail" required/>
      </p>
      <p class="input-record" id="input-phone">
        <span class="form-tag">Phone</span>
        <input class="input-val" type="tel" name="phone" required/>
      </p>
      <p class="input-record" id="input-subject">
        <span class="form-tag">Subject</span>
        <input class="input-val" type="text" name="subject" required/>
      </p>
      <p class="input-record" id="input-message">
        <span class="form-tag">Message</span>
        <input class="input-val" type="textarea" name="message" rows="10" cols="20" wrap="hard" required/>
      </p>
      <p class="button-record">
        <span id="button-wrapper">
          <i
            class="fas fa-caret-right faa-flash animated button-icon"
            data-fa-transform="grow-8"
          ></i>
          <input type="submit" value="Send by Mail" />
        </span>
      </p>
    </div>
  </form>
</div>