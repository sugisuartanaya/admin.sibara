$.noConflict();

jQuery(document).ready(function($) {

	"use strict";

	[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
		new SelectFx(el);
	});

	jQuery('.selectpicker').selectpicker;


	

	$('.search-trigger').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').addClass('open');
	});

	$('.search-close').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').removeClass('open');
	});

	$('.equal-height').matchHeight({
		property: 'max-height'
	});

	// var chartsheight = $('.flotRealtime2').height();
	// $('.traffic-chart').css('height', chartsheight-122);


	// Counter Number
	$('.count').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 3000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			}
		});
	});


	 
	 
	// Menu Trigger
	$('#menuToggle').on('click', function(event) {
		var windowWidth = $(window).width();   		 
		if (windowWidth<1010) { 
			$('body').removeClass('open'); 
			if (windowWidth<760){ 
				$('#left-panel').slideToggle(); 
			} else {
				$('#left-panel').toggleClass('open-menu');  
			} 
		} else {
			$('body').toggleClass('open');
			$('#left-panel').removeClass('open-menu');  
		} 
			 
	}); 

	 
	$(".menu-item-has-children.dropdown").each(function() {
		$(this).on('click', function() {
			var $temp_text = $(this).children('.dropdown-toggle').html();
			$(this).children('.sub-menu').prepend('<li class="subtitle">' + $temp_text + '</li>'); 
		});
	});


	// Load Resize 
	$(window).on("load resize", function(event) { 
		var windowWidth = $(window).width();  		 
		if (windowWidth<1010) {
			$('body').addClass('small-device'); 
		} else {
			$('body').removeClass('small-device');  
		} 
		
	}); 


  $(document).ready(function() {
    $('#tabel').DataTable();
  });

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})

	$(document).ready(function(){
		// Inisialisasi datepicker
		$('#tanggal').datetimepicker({
      format: 'YYYY-MM-DD'
    });

		$('#datetimepicker1').datetimepicker({
      format: 'YYYY-MM-DD HH:mm',
			sideBySide: true,
			date: 'fa fa-calendar',
    });
		
		$('#datetimepicker').datetimepicker({
      format: 'YYYY-MM-DD HH:mm',
			sideBySide: true,
    });
	});

	$(document).ready(function() {
		var maxFileCount = 6;

        $('#tambahanFotoBarang').on('change', '.foto_barang', function() {
            // Jika pengguna memilih satu file
            if (this.files.length === 1) {
                // Jika belum mencapai batas maksimal file
                if ($('.foto_barang').length < maxFileCount) {
                    // Tambahkan input file baru
                    addNewInputFile();
                } else {
                    alert('Anda telah mencapai batas maksimal file (5 foto).');
                    // Hapus file yang baru dipilih karena sudah mencapai batas
                    $(this).val('');
                }
            }
        });

		function addNewInputFile() {
				var newInput = 
				'<input type="file" id="foto_barang" name="foto_barang[]" class="form-control foto_barang" multiple accept="image/*"> <br>';
				$('#tambahanFotoBarang').append(newInput);
		}
	});

	//active class preview barang
	$(document).ready(function(){
		$('#thumbnailCarousel .thumbnail').click(function(){
				$('#thumbnailCarousel .thumbnail').removeClass('active');
				$(this).addClass('active');
		});
	});

	//zoom hover thumbnail
	$(document).ready(function() {
    var magnifyingGlass = $('.magnifying-glass');

    $('#produkCarousel .carousel-inner').hover(
        function() {
            magnifyingGlass.show();
        },
        function() {
            magnifyingGlass.hide();
            resetImageSize();
        }
    ).mousemove(function(e) {
        var parentOffset = $(this).offset();
        var x = e.pageX - parentOffset.left;
        var y = e.pageY - parentOffset.top;

        var scale = 1.5; // Sesuaikan faktor zoom sesuai keinginan
        var transformValue = 'scale(' + scale + ')';
        
        magnifyingGlass.css({
            left: x - magnifyingGlass.width() / 2,
            top: y - magnifyingGlass.height() / 2,
            transform: transformValue,
            'transform-origin': x + 'px ' + y + 'px'
        });

        $('#produkCarousel .carousel-item.active img').css({
            transform: transformValue,
            'transform-origin': x + 'px ' + y + 'px'
        });
    });

    function resetImageSize() {
        $('#produkCarousel .carousel-item.active img').css({
            transform: 'scale(1)',
            'transform-origin': 'center center'
        });
    }
	});
	
	$(document).ready(function() {
    $(".standardSelect").chosen({
        disable_search_threshold: 10,
        no_results_text: "Oops, nothing found!",
        width: "100%"
    });
	});

	$(document).ready(function() {
		var endDate = document.getElementById("end_date").getAttribute("dataEndDate");
        var myCountDown = new ysCountDown(endDate, function (remaining, finished) {
				console.log(myCountDown);
				if (finished) {
						console.log('testing');
						document.getElementById("end_event").style.display = "block";
						document.getElementById("hide_whatsapp").style.display = "none";
				} else {
						document.getElementById("countdown").innerHTML = remaining.hours + "h : " + remaining.minutes + "m : " + remaining.seconds + "s";
				}
			});
	});

	$(document).ready(function() {
		$('#tahun').change(function() {
			var selectedValue = $(this).val();
			var newUrl = "/report/" + selectedValue;
			$('#terapkanLink').attr('href', newUrl);
		});
	});

	$(document).ready(function() {
		$('#tahun').change(function() {
				$('#terapkanButton').prop('disabled', false); // Menghapus atribut disabled saat memilih tahun
		});
	});

	$(document).ready(function() {
		var reportForm = $('#reportForm');
		var jadwalSelect = $('#jadwal');

		jadwalSelect.change(function() {
				var selectedJadwalId = $(this).val();
				var selectedOption = $(this).find('option:selected');
				var selectedTahun = selectedOption.data('tahun');
				var actionUrl = "/report/" + selectedTahun + "/" + selectedJadwalId + "/detail";
				reportForm.attr('action', actionUrl);
		});
	});

	$(document).ready(function(){
		$('.plhButton').click(function(){
				$(this).closest('.modal-body').find('.plhInput').toggle();
				$(this).hide(); // Menghilangkan tombol "Terdapat PLH?" setelah diklik
		});
		$('#kwitansiForm').submit(function() {
			$('#kasiInput').prop('disabled', false); // Mengaktifkan input sebelum form disubmit
		});
	});

	
});

