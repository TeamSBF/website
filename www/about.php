<?php
    require_once"header.php"; 
?>
  <div class="container">
    <div class="grid_8 alpha">
      <h1>About Us</h1>
      <section>
        <h3>Our Mission</h3>
        <p>Sit and Be Fit is committed to improving the quality of life of older adults and physically limited individuals through safe, effective exercises that are available through television, videos, personal appearances, classes, seminars, books, and the Internet.</p>

        <p>Sit and Be Fit actively promotes functional fitness, healing, and independence, and is an effective resource for professionals in aging and fitness.</p>
        <h3>History</h3>
        <p>In 2000, after operating as a corporation for 13 years, Sit and Be Fit applied for, and was granted non-profit status as a 501(c)(3) charitable organization. We are able to accept funding from a variety of sources: foundations, government grants, and private donations from individuals; including bequests and legacies. These donations are tax-deductible.</p>
        <h3>Support Our Non-Profit Organization!</h3>
        <p>Sit and Be Fit depends on the support of people like you as we continue our outreach to the millions who benefit from Sit and Be Fit's unique programs.</p>

        <p>Your support enables Sit and Be Fit to:</p>
        <ul>
          <li>Produce new public television exercise programs on a regular basis</li>
          <li>Reach more viewers who will benefit by adding more TV stations to our network</li>
          <li>Promote awareness of the wellness benefits and accessibility of the Sit and Be Fit TV program to the health care community</li>
          <li>Produce Specialty Exercise Videos to benefit people with specific medical conditions</li>
          <li>Expand its  Exercise Instructor Continuing Education Program</li>
          <li>Offer free exercise and health information in response to the hundreds of telephone and e-mail inquiries received each month</li>
          <li>Update the quality of the company's services available over the Internet</li>
        </ul>
        <h3>How to Give:</h3>
          <p>To provide you with the very best exercise programs, funding for research and development is crucial! There is something everyone can do to help Sit and Be Fit make a difference in the quality of life for older adults and others through exercise, including:</p>
        <ul>
          <li>Direct contributions</li>
          <li>Planned estate giving</li>
          <li>Purchase Sit and Be Fit products for your family and friends.</li>
          <li>Tell your friends and family about Sit and Be Fit programs.</li>
          <li>Ask your local public television stations to air Sit and Be Fit three or more days each week at times convenient for older adults and others.</li>
          <li>Tell your doctor, other health care providers, and fitness professionals in local communities about Sit and Be Fit programs.</li>
        </ul>
        </section>
    </div>
    <div class="grid_4 omega">
      <h1>Login</h1>
      <section>
        <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
        <input type="hidden" name="key" value="<?=$_SESSION['regKey'];?>" />
            <div>
                <input type="text" name="email" placeholder="Email Address" />
            </div>
            <div>
                <input type="password" name="password" placeholder="Password" />
            </div>
            <div>
                Need to Register?<a href="registration.html">Register</a>
            </div>
          <div>
            <button type="submit">Login</button>
          </div>
        </form>
    </section>
    </div>
</body>
</html>