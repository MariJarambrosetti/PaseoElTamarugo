jQuery(document).ready(function($){
	var eventStarts = $("#eventStarts").val();
	var eventEnds = $("#eventEnds").val();
	var eventStartsIn = $("#eventStartsIn").val();
	var eventStartsToday = $("#eventStartsToday").val();
	var eventHasExpired = $("#eventHasExpired").val();

	var startDate = new Date(eventStarts).getTime();
	var x = setInterval(function() {

		// Get current date and time
		var now = new Date().getTime();

		// Find the distance between current date an the event's start date
		var distance = startDate - now;

		// Calculate days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		// Output the values
		if (distance > 0) {
			document.getElementById("event-countdown").innerHTML = eventStartsIn + ":";
			document.getElementById("event-countdown-days").innerHTML = days;
			document.getElementById("event-countdown-hours").innerHTML = hours;
			document.getElementById("event-countdown-min").innerHTML = minutes;
			document.getElementById("event-countdown-sec").innerHTML = seconds;
		}
		else if (0 > distance) {
			clearInterval(x);
			document.getElementById("event-countdown").innerHTML = eventHasExpired + "!";
			document.getElementById("event-countdown-days").innerHTML = "-";
			document.getElementById("event-countdown-hours").innerHTML = "-";
			document.getElementById("event-countdown-min").innerHTML = "-";
			document.getElementById("event-countdown-sec").innerHTML = "-";
		}
		else if (0 == distance) {
			clearInterval(x);
			document.getElementById("event-countdown").innerHTML = eventStartsToday + "!";
			document.getElementById("event-countdown-days").innerHTML = "0";
			document.getElementById("event-countdown-hours").innerHTML = "0";
			document.getElementById("event-countdown-min").innerHTML = "0";
			document.getElementById("event-countdown-sec").innerHTML = "0";
		}
	}, 1000);
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_gallery_img1_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_gallery_img1').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_gallery_img2_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_gallery_img2').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_gallery_img3_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_gallery_img3').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_gallery_img4_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_gallery_img4').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_gallery_img5_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_gallery_img5').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_gallery_img6_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_gallery_img6').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_gallery_img7_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_gallery_img7').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_gallery_img8_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_gallery_img8').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_sponsor_img1_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_sponsor_img1').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_sponsor_img2_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_sponsor_img2').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_sponsor_img3_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_sponsor_img3').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_sponsor_img4_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_sponsor_img4').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_sponsor_img5_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_sponsor_img5').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_sponsor_img6_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_sponsor_img6').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_media_sponsor_img1_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_media_sponsor_img1').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_media_sponsor_img2_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_media_sponsor_img2').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_media_sponsor_img3_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_media_sponsor_img3').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_media_sponsor_img4_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_media_sponsor_img4').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_media_sponsor_img5_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_media_sponsor_img5').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_media_sponsor_img6_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_media_sponsor_img6').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});

jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#event_schedule_file_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#event_schedule_file').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
});