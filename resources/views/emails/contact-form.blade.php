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
			<h1>New Contact Form Submission</h1>
		</div>
		<div class="content">
			<div class="field">
				<div class="label">Name:</div>
				<div>{{ e($contact->name) }}</div>
			</div>
			<div class="field">
				<div class="label">Email:</div>
				<div>{{ e($contact->email) }}</div>
			</div>
			<div class="field">
				<div class="label">Phone:</div>
				<div>{{ e($contact->phone) }}</div>
			</div>
			<div class="field">
				<div class="label">Inquiry Type:</div>
				<div>{{ e($contact->inquiry_type) }}</div>
			</div>
			<div class="field">
				<div class="label">Message:</div>
				<div>{!! nl2br(e($contact->message)) !!}</div>
			</div>
			<hr>
			<div class="field">
				<div class="label">Additional Information:</div>
				<div>Location: {{ e($contact->city) }}, {{ e($contact->country) }}</div>
				<div>Spam Score: {{ e($contact->spam_score) }}</div>
				<div>Submitted at: {{ e($contact->created_at->format('Y-m-d h:i A')) }}</div>
			</div>
		</div>
	</div>
</body>

</html>
