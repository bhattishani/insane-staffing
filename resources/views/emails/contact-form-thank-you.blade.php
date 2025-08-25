<!DOCTYPE html>
<html>

<head>
	<style>
		body {
			font-family: Arial, sans-serif;
			line-height: 1.6;
			color: #333;
		}

		.container {
			max-width: 600px;
			margin: 0 auto;
			padding: 20px;
		}

		.header {
			background-color: #1f2937;
			color: white;
			padding: 20px;
			text-align: center;
		}

		.content {
			padding: 20px;
			background-color: #f9fafb;
		}

		.thank-you {
			font-size: 18px;
			margin-bottom: 20px;
		}

		.details {
			margin-top: 30px;
			padding: 15px;
			background-color: #ffffff;
			border-radius: 5px;
		}

		.field {
			margin-bottom: 15px;
		}

		.label {
			font-weight: bold;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="header">
			<h1>Thank You for Contacting Us</h1>
		</div>
		<div class="content">
			<div class="thank-you">
				Dear {{ e($contact->name) }},
			</div>
			<p>Thank you for reaching out to us. We have received your inquiry and our team will review it promptly. You can
				expect to hear back from us soon.</p>

			<div class="details">
				<h3>Your Submission Details:</h3>
				<div class="field">
					<div class="label">Inquiry Type:</div>
					<div>{{ e($contact->inquiry_type) }}</div>
				</div>
				<div class="field">
					<div class="label">Message:</div>
					<div>{!! nl2br(e($contact->message)) !!}</div>
				</div>
			</div>

			<div
				class="details"
				style="margin-top: 30px;"
			>
				<h3>Contact Information</h3>
				<p>Feel free to call or email us. We are available around the clock to assist you with your staffing needs or career
					questions.</p>

				<div class="field">
					<div class="label">Call us 24/7:</div>
					<div>+1 (647) 267-0072</div>
				</div>

				<div class="field">
					<div class="label">Email us:</div>
					<div><a
							href="mailto:insanestaffing@gmail.com"
							style="color: #1f2937;"
						>insanestaffing@gmail.com</a></div>
				</div>

				<div class="field">
					<div class="label">Website:</div>
					<div><a
							href="https://insanestaffing.ca/"
							style="color: #1f2937;"
						>https://insanestaffing.ca/</a></div>
				</div>
			</div>

			<p>Best regards,<br>Insane Staffing Team</p>
		</div>
	</div>
</body>

</html>
