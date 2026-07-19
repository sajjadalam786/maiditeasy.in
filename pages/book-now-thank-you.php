<?php
$page_title = "Thank You - Maid It Easy";
$page_description = "Your submission has been received successfully. Our team will contact you soon.";
$canonical_url = "https://maiditeasy.in/pages/book-now-thank-you.php";
$additional_styles = "
        /* Button styles */
        .button {
          background-color: #fed10c;
          border: none;
          color: darkblue;
          padding: 20px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 14px;
          margin: 4px 2px;
          font-weight: 600;
        }
        .button3 {
          border-radius: 8px;
        }
";
include '../includes/header.php';
?>
    <main>
        <section class="tp-service-details-area pt-120 pb-90 text-center">
          <div class="container">
            <h2 class="tp-section-title heading-color-black pt-10 mb-20">Thank You!</h2>
            <p style="font-size: 18px; color: #555;">Your submission has been received successfully. Our team will contact you soon.</p>
            <a href="../index.php" class="button button3 mt-3">Go Back to Home</a>
          </div>
        </section>

        <!-- Our Offices Section (Unique to Thank You Page) -->
        <section class="pb-60">
          <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="offices-container text-center">
                        <h4 class="tp-contact-info-title mb-25">Our Offices</h4>
                        <p><strong>Hyderabad:</strong> 2ND FLOOR, PLOT NO 2, SECTOR 1 SY NO 64, Huda Techno Enclave, Madhapur, Rangareddy, Telangana, 500081</p>
                        <p><strong>Bengaluru:</strong> Saket Callipolis, Sarjapur-Marathalli Road - 560035</p>
                        <p><strong>Pune:</strong> City Vista, Kharadi - 411014</p>
                        <p><strong>Chennai:</strong> Spencer Plaza, Mount Road - 600002</p>
                        <p><strong>Gurugram:</strong> Plot no. 11, Sector 33 - 122005</p>
                    </div>
                </div>
            </div>
          </div>
        </section>
    </main>
<?php
include '../includes/footer.php';
?>
