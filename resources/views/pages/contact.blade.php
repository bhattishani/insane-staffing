@extends('layouts.main')

@section('title', 'Contact Insane Staffing | 24/7 Support | Get in Touch')

@section('meta')
    <meta
        content="Contact Insane Staffing for all your staffing needs. Available 24/7 via phone or email. Get expert recruitment solutions for your business or find your next career opportunity."
        name="description">
    <meta
        content="contact Insane Staffing, staffing agency contact, recruitment agency toronto, hiring support, job search help, staffing solutions contact"
        name="keywords">
    <meta content="Insane Staffing" name="author">
    <meta content="Contact Insane Staffing | Available 24/7" property="og:title">
    <meta
        content="Get in touch with Canada's leading staffing agency. Available 24/7 for all your recruitment and career needs."
        property="og:description">
    <meta content="{{ asset('assets/images/resources/insane-staffing-logo-black-text.png') }}" property="og:image">
    <meta content="https://insanestaffing.ca/contact" property="og:url">
    <meta content="summary_large_image" name="twitter:card">
    <meta content="Contact Insane Staffing | 24/7 Support" name="twitter:title">
    <meta content="Need staffing solutions? Contact us anytime. Available 24/7 to help with your recruitment needs."
        name="twitter:description">
    <link href="https://insanestaffing.ca/contact" rel="canonical">
    <meta content="index, follow" name="robots">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@section('style')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        nav.scrolled {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-radius: 50%;
            border-top: 3px solid #1f2937;
            animation: spin 1s linear infinite;
            margin-left: 10px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .button-content {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            padding: 20px;
        }

        .modal-content {
            background-color: white;
            max-width: 500px;
            margin: 50px auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transform: translateY(-50px);
            opacity: 0;
            transition: all 0.3s ease-out;
        }

        .modal.active .modal-content {
            transform: translateY(0);
            opacity: 1;
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            color: #4b5563;
            transition: color 0.2s;
        }

        .social-links a:hover {
            color: #1f2937;
        }

        /* File upload styles */
        #file-list {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e0 #f7fafc;
        }

        #file-list::-webkit-scrollbar {
            width: 6px;
        }

        #file-list::-webkit-scrollbar-track {
            background: #f7fafc;
            border-radius: 3px;
        }

        #file-list::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 3px;
        }

        #file-list::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }

        .file-item-hover:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('main')
    <!-- Page Header -->
    <section class="bg-dark-700 text-white text-center py-16">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold">Get In Touch</h1>
            <p class="mt-2 text-lg text-dark-200">We're here to help 24/7. Reach out to us anytime.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="flex flex-row items-center gap-4 mb-8" id="success-message" style="display: none">
                <i class="fas fa-check-circle text-green-500 text-4xl"></i>
                <h3 class="text-2xl font-bold text-gray-900">
                    Thank You for Contacting Us!
                </h3>
            </div>
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-6">Send Us a Message</h2>
                    <form action="{{ route('contact.submit') }}" method="POST" enctype="multipart/form-data"
                        onsubmit="return false">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2" for="name">Name</label>
                            <input
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                id="name" name="name" required type="text">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2" for="email">Email</label>
                            <input
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                id="email" name="email" required type="email">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2" for="phone">Phone</label>
                            <input
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                id="phone" name="phone" required type="tel">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2" for="inquiry_type">I am a...</label>
                            <select
                                class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                id="inquiry_type" name="inquiry_type">
                                <option value="Business">Business</option>
                                <option selected value="Job Seeker">Job Seeker</option>
                            </select>
                        </div>
                        <div class="mb-4" id="attachment-upload-section" style="display: none;">
                            <label class="block text-gray-700 font-semibold mb-2" for="attachment_files">Upload Files (CV,
                                Portfolio, etc.)</label>

                            <!-- File Input (Hidden after selection) -->
                            <div id="file-input-container">
                                <input
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    id="attachment_files" type="file" multiple
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.bmp,.webp,.mp4,.avi,.mov,.wmv,.flv,.webm,.xls,.xlsx,.csv">
                                <div class="mt-2 space-y-1">
                                    <p class="text-sm text-gray-600"><strong>Allowed file types:</strong> PDF, Word, Images
                                        (JPG, PNG, GIF, etc.), Videos (MP4, AVI, MOV, etc.), Excel/CSV</p>
                                    <p class="text-sm text-gray-600"><strong>Maximum:</strong> 5 files, 100MB total</p>
                                </div>
                            </div>

                            <!-- Add More Files Button -->
                            <div id="add-more-container" style="display: none;" class="mt-3">
                                <button type="button" id="add-more-files"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                                    <i class="fas fa-plus mr-2"></i>Add More Files
                                </button>
                            </div>

                            <!-- Error Display -->
                            <div class="mt-2">
                                <p class="text-sm text-red-600" id="file-error" style="display: none;"></p>
                            </div>

                            <!-- File Preview List -->
                            <div id="file-preview" class="mt-4" style="display: none;">
                                <div class="flex justify-between items-center mb-3">
                                    <p class="text-sm font-medium text-gray-700">Selected files:</p>
                                    <span class="text-xs text-gray-500" id="file-count">0/5 files</span>
                                </div>
                                <div id="file-list"
                                    class="space-y-2 max-h-60 overflow-y-auto border rounded-lg p-3 bg-gray-50"></div>
                                <div class="mt-2 flex justify-between items-center text-xs text-gray-600">
                                    <span id="total-size">Total size: 0 MB</span>
                                    <button type="button" id="clear-all-files" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash mr-1"></i>Clear All
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2" for="message">Message</label>
                            <textarea class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                id="message" name="message" required rows="5"></textarea>
                        </div>
                        <div class="mb-6">
                            <div class="g-recaptcha" data-sitekey="{{ config('recaptcha.site_key') }}"></div>
                        </div>
                        <div class="mb-4 text-red-600 hidden" id="form-error"></div>
                        <div>
                            <button
                                class="w-full bg-dark-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-dark-700 transition-colors"
                                id="submit-button" type="submit">
                                <span class="button-content">
                                    <span>Send Message</span>
                                    <span class="spinner" id="submit-spinner"></span>
                                </span>
                            </button>
                        </div>
                        <input id="device_fingerprint" name="device_fingerprint" type="hidden">
                    </form>
                </div>
                <!-- Contact Info -->
                <div class="space-y-8">
                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        <h3 class="text-2xl font-bold mb-4">Contact Information</h3>
                        <p class="text-lg mb-4">Feel free to call or email us. We are available around the clock to
                            assist you with your staffing needs or career questions.</p>
                        <div class="space-y-4">
                            <p class="text-lg flex items-center">
                                <i class="fas fa-phone text-dark-600 mr-4"></i>
                                <span>
                                    <span class="font-semibold block">Call us 24/7:</span>
                                    <a class="text-gray-700 hover:text-dark-600" href="tel:+16472670072">+1 (647)
                                        267-0072</a>
                                </span>
                            </p>
                            <p class="text-lg flex items-center">
                                <i class="fas fa-envelope text-dark-600 mr-4"></i>
                                <span>
                                    <span class="font-semibold block">Email us:</span>
                                    <a class="text-gray-700 hover:text-dark-600"
                                        href="mailto:insanestaffing@gmail.com">insanestaffing@gmail.com</a>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        <h3 class="text-2xl font-bold mb-4">Connect With Us</h3>
                        <div class="flex space-x-4">
                            <a class="text-gray-600 hover:text-dark-600 text-3xl"
                                href="https://www.instagram.com/insanestaffing" rel="noopener noreferrer"
                                target="_blank"><i class="fab fa-instagram"></i></a>
                            <a class="text-gray-600 hover:text-dark-600 text-3xl"
                                href="https://www.linkedin.com/company/insane-staffing" rel="noopener noreferrer"
                                target="_blank"><i class="fab fa-linkedin"></i></a>
                            <a class="text-gray-600 hover:text-dark-600 text-3xl" href="https://x.com/InsaneStaffing"
                                rel="noopener noreferrer" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a class="text-gray-600 hover:text-dark-600 text-3xl"
                                href="https://www.facebook.com/share/1AM1tcqV9L" rel="noopener noreferrer"
                                target="_blank"><i class="fab fa-facebook"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Modal -->
    <div class="modal" id="success-modal">
        <div class="modal-content">
            <div class="modal-header flex flex-row items-center gap-4">
                <i class="fas fa-check-circle text-green-500 text-4xl"></i>
                <h3 class="text-2xl font-bold text-gray-900">
                    Thank You for Contacting Us!
                </h3>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <p class="text-gray-600 mb-4">Your message has been successfully sent. Our team will process your
                        request and
                        contact you as soon as possible.</p>
                    <p class="text-gray-600">Meanwhile, please feel free to explore our social media channels for more
                        updates and
                        information about our services:</p>
                </div>
                <div class="social-links text-2xl">
                    <a href="https://www.instagram.com/insanestaffing" rel="noopener noreferrer" target="_blank"
                        title="Follow us on Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/company/insane-staffing" rel="noopener noreferrer" target="_blank"
                        title="Connect with us on LinkedIn"><i class="fab fa-linkedin"></i></a>
                    <a href="https://x.com/InsaneStaffing" rel="noopener noreferrer" target="_blank"
                        title="Follow us on X"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.facebook.com/share/1AM1tcqV9L" rel="noopener noreferrer" target="_blank"
                        title="Like us on Facebook"><i class="fab fa-facebook"></i></a>
                </div>
            </div>
            <div class="modal-footer">
                <button class="bg-dark-600 text-white px-4 py-2 rounded hover:bg-dark-700 transition-colors"
                    id="close-modal" type="button">Close</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
    <script>
        // Cookie management functions
        const setCookie = (name, value, days) => {
            const d = new Date();
            d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
            const expires = "expires=" + d.toUTCString();
            document.cookie = name + "=" + value + ";" + expires + ";path=/";
        };

        const getCookie = (name) => {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        };

        $(document).ready(async function() {
            const fpPromise = FingerprintJS.load();
            const $successMessage = $('#success-message');

            // Check for success cookie on page load
            const submittedVisitorId = getCookie('contact_submitted');
            const currentVisitorId = getCookie('visitor_id');

            if (submittedVisitorId && currentVisitorId && submittedVisitorId === currentVisitorId) {
                $successMessage.show();
            }

            // Get the visitor identifier when you need it.
            fpPromise
                .then(fp => fp.get())
                .then(result => {
                    // This is the visitor identifier:
                    const visitorId = result.visitorId;
                    $('#device_fingerprint').val(visitorId);
                    // Store visitor ID in cookie
                    setCookie('visitor_id', visitorId, 30); // Store for 30 days
                });

            // File management array
            let selectedFiles = [];
            let fileIdCounter = 0;

            // Show/hide attachment upload based on inquiry type
            function toggleAttachmentSection() {
                const $attachmentSection = $('#attachment-upload-section');
                if ($('#inquiry_type').val() === 'Job Seeker') {
                    $attachmentSection.show();
                } else {
                    $attachmentSection.hide();
                    clearAllFiles();
                }
            }

            // Initialize attachment section based on default selection
            toggleAttachmentSection();

            $('#inquiry_type').on('change', function() {
                toggleAttachmentSection();
            });

            // File input change handler
            $('#attachment_files').on('change', function() {
                const files = this.files;
                if (files.length > 0) {
                    addFilesToArray(files);
                    $(this).val(''); // Clear input to allow selecting same files again
                }
            });

            // Add more files button
            $('#add-more-files').on('click', function() {
                $('#attachment_files').click();
            });

            // Clear all files button
            $('#clear-all-files').on('click', function() {
                clearAllFiles();
            });

            function addFilesToArray(files) {
                const $errorDiv = $('#file-error');
                $errorDiv.hide();

                const allowedTypes = [
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/bmp', 'image/webp',
                    'video/mp4', 'video/avi', 'video/quicktime', 'video/x-ms-wmv', 'video/x-flv',
                    'video/webm',
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'text/csv'
                ];

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];

                    // Check if we've reached the limit
                    if (selectedFiles.length >= 5) {
                        $errorDiv.text('Maximum 5 files allowed.').show();
                        break;
                    }

                    // Check if file already exists
                    const existingFile = selectedFiles.find(f => f.name === file.name && f.size === file.size);
                    if (existingFile) {
                        $errorDiv.text(`File "${file.name}" is already selected.`).show();
                        continue;
                    }

                    // Check file type
                    if (!allowedTypes.includes(file.type)) {
                        $errorDiv.text(`File "${file.name}" is not an allowed file type.`).show();
                        continue;
                    }

                    // Check total size
                    const currentTotalSize = selectedFiles.reduce((total, f) => total + f.size, 0);
                    if (currentTotalSize + file.size > 100 * 1024 * 1024) {
                        $errorDiv.text('Total file size would exceed 100MB limit.').show();
                        continue;
                    }

                    // Add file to array
                    selectedFiles.push({
                        id: ++fileIdCounter,
                        file: file,
                        name: file.name,
                        size: file.size,
                        type: file.type
                    });
                }

                updateFilePreview();
            }

            function removeFile(fileId) {
                selectedFiles = selectedFiles.filter(f => f.id !== fileId);
                updateFilePreview();
                $('#file-error').hide();
            }

            function clearAllFiles() {
                selectedFiles = [];
                updateFilePreview();
                $('#file-error').hide();
            }

            function updateFilePreview() {
                const $previewDiv = $('#file-preview');
                const $fileList = $('#file-list');
                const $fileCount = $('#file-count');
                const $totalSize = $('#total-size');
                const $addMoreContainer = $('#add-more-container');
                const $fileInputContainer = $('#file-input-container');

                if (selectedFiles.length === 0) {
                    $previewDiv.hide();
                    $addMoreContainer.hide();
                    $fileInputContainer.show();
                    return;
                }

                // Show/hide containers
                $previewDiv.show();
                $fileInputContainer.hide();
                $addMoreContainer.show();

                // Update file count
                $fileCount.text(`${selectedFiles.length}/5 files`);

                // Calculate total size
                const totalSize = selectedFiles.reduce((total, f) => total + f.size, 0);
                $totalSize.text(`Total size: ${(totalSize / 1024 / 1024).toFixed(2)} MB`);

                // Clear and rebuild file list
                $fileList.empty();

                selectedFiles.forEach(fileObj => {
                    const fileType = getFileTypeIcon(fileObj.type);
                    const fileSize = (fileObj.size / 1024 / 1024).toFixed(2);
                    const truncatedName = truncateFileName(fileObj.name, 30);

                    const fileItem = $(`
                        <div class="flex items-center justify-between p-2 bg-white rounded border hover:bg-gray-50 transition-colors">
                            <div class="flex items-center space-x-3 flex-1 min-w-0">
                                <i class="fas ${fileType.icon} ${fileType.color} flex-shrink-0"></i>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate" title="${fileObj.name}">
                                        ${truncatedName}
                                    </p>
                                    <p class="text-xs text-gray-500">${fileSize} MB</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 flex-shrink-0">
                                <button type="button" class="text-blue-600 hover:text-blue-800 text-sm" onclick="previewFile(${fileObj.id})">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="text-red-600 hover:text-red-800 text-sm" onclick="removeFile(${fileObj.id})">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    `);

                    $fileList.append(fileItem);
                });

                // Hide add more button if limit reached
                if (selectedFiles.length >= 5) {
                    $addMoreContainer.hide();
                }
            }

            function truncateFileName(fileName, maxLength) {
                if (fileName.length <= maxLength) {
                    return fileName;
                }

                const extension = fileName.split('.').pop();
                const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.'));
                const truncatedName = nameWithoutExt.substring(0, maxLength - extension.length - 4) + '...';

                return truncatedName + '.' + extension;
            }

            function getFileTypeIcon(mimeType) {
                if (mimeType.startsWith('image/')) {
                    return {
                        icon: 'fa-image',
                        color: 'text-green-600'
                    };
                } else if (mimeType.startsWith('video/')) {
                    return {
                        icon: 'fa-video',
                        color: 'text-red-600'
                    };
                } else if (mimeType === 'application/pdf') {
                    return {
                        icon: 'fa-file-pdf',
                        color: 'text-red-600'
                    };
                } else if (mimeType.includes('word')) {
                    return {
                        icon: 'fa-file-word',
                        color: 'text-blue-600'
                    };
                } else if (mimeType.includes('excel') || mimeType.includes('csv')) {
                    return {
                        icon: 'fa-file-excel',
                        color: 'text-green-600'
                    };
                } else {
                    return {
                        icon: 'fa-file',
                        color: 'text-gray-600'
                    };
                }
            }

            function previewFile(fileId) {
                const fileObj = selectedFiles.find(f => f.id === fileId);
                if (!fileObj) return;

                const file = fileObj.file;

                if (file.type.startsWith('image/')) {
                    // Create image preview modal for images
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const modal = $(`
                            <div class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50" id="preview-modal">
                                <div class="max-w-4xl max-h-full p-4">
                                    <div class="bg-white rounded-lg p-4">
                                        <div class="flex justify-between items-center mb-4">
                                            <h3 class="text-lg font-semibold">${file.name}</h3>
                                            <button type="button" class="text-gray-500 hover:text-gray-700" onclick="$('#preview-modal').remove()">
                                                <i class="fas fa-times text-xl"></i>
                                            </button>
                                        </div>
                                        <img src="${e.target.result}" alt="${file.name}" class="max-w-full max-h-96 mx-auto">
                                    </div>
                                </div>
                            </div>
                        `);
                        $('body').append(modal);
                    };
                    reader.readAsDataURL(file);
                } else {
                    // For non-image files, create blob URL and open in new tab
                    try {
                        const blob = new Blob([file], {
                            type: file.type
                        });
                        const blobUrl = URL.createObjectURL(blob);

                        // Open in new tab
                        const newWindow = window.open(blobUrl, '_blank');

                        // Clean up the blob URL after a delay to allow the browser to load it
                        setTimeout(() => {
                            URL.revokeObjectURL(blobUrl);
                        }, 1000);

                        // If popup was blocked, show fallback message
                        if (!newWindow || newWindow.closed || typeof newWindow.closed == 'undefined') {
                            alert(
                                `Popup blocked! File: ${file.name}\nSize: ${(file.size / 1024 / 1024).toFixed(2)} MB\nType: ${file.type}\n\nPlease allow popups to preview files.`);
                        }
                    } catch (error) {
                        console.error('Error creating blob URL:', error);
                        alert(
                            `Unable to preview file: ${file.name}\nSize: ${(file.size / 1024 / 1024).toFixed(2)} MB\nType: ${file.type}`);
                    }
                }
            }

            // Make functions global for onclick handlers
            window.removeFile = removeFile;
            window.previewFile = previewFile;

            // Form submission
            $('form').on('submit', function(e) {
                e.preventDefault();
                const $form = $(this);
                const $submitButton = $('#submit-button');
                const $submitSpinner = $('#submit-spinner');
                const $errorDiv = $('#form-error');
                const $inputs = $form.find('input, textarea, select');

                // Reset validation styling
                $inputs.removeClass('border-red-500');
                $errorDiv.addClass('hidden');
                $submitButton.prop('disabled', true);
                $submitSpinner.show();

                // Create FormData object
                const formData = new FormData();

                // Add form fields
                formData.append('_token', $('input[name="_token"]').val());
                formData.append('name', $('#name').val());
                formData.append('email', $('#email').val());
                formData.append('phone', $('#phone').val());
                formData.append('inquiry_type', $('#inquiry_type').val());
                formData.append('message', $('#message').val());
                formData.append('device_fingerprint', $('#device_fingerprint').val());

                // Add reCAPTCHA response
                if (typeof grecaptcha !== 'undefined') {
                    formData.append('g-recaptcha-response', grecaptcha.getResponse());
                }

                // Add selected files
                selectedFiles.forEach((fileObj, index) => {
                    formData.append(`attachment_files[${index}]`, fileObj.file);
                });

                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    success: function(data) {
                        $form[0].reset();
                        if (typeof grecaptcha !== 'undefined') {
                            grecaptcha.reset();
                        }

                        // Hide attachment section after reset
                        $('#attachment-upload-section').hide();
                        clearAllFiles();

                        // Store submission in cookie
                        const visitorId = $('#device_fingerprint').val();
                        setCookie('contact_submitted', visitorId, 30);

                        // Show success message
                        $('#success-message').show();

                        // Show success modal
                        const $modal = $('#success-modal');
                        $modal.show();
                        setTimeout(() => $modal.addClass('active'), 10);

                        // Handle modal close
                        const closeModal = () => {
                            $modal.removeClass('active');
                            setTimeout(() => $modal.hide(), 300);
                        };

                        // Close modal on button click
                        $('#close-modal').on('click', closeModal);

                        // Close modal on outside click
                        $modal.on('click', function(e) {
                            if (e.target === this) closeModal();
                        });

                        // Close modal on escape key
                        $(document).on('keydown', function(e) {
                            if (e.key === 'Escape' && $modal.is(':visible')) {
                                closeModal();
                            }
                        });
                    },
                    error: function(xhr) {
                        const data = xhr.responseJSON;

                        if (data && data.errors) {
                            $.each(data.errors, function(key, value) {
                                const $input = $form.find(`[name="${key}"]`);
                                if ($input.length) {
                                    $input.addClass('border-red-500');
                                }
                            });
                            $errorDiv.text(Object.values(data.errors).flat().join(' '))
                                .removeClass('hidden');
                        } else {
                            $errorDiv.text(data && data.message ? data.message :
                                'An error occurred. Please try again.').removeClass(
                                'hidden');
                        }
                    },
                    complete: function() {
                        $submitButton.prop('disabled', false);
                        $submitSpinner.hide();
                    }
                });
            });
        });
    </script>
@endsection
