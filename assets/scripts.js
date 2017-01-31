function loadPosts(url) {
	setTimeout(function() {
		$.get(url, function(data, status) {
			if ($("#postscontent").html() === "Loading...") {
				$("#postscontent").html("");
			}
			if (status === "success") {
				if (data === "") {
					$(".load-more").parent().html("That's all, folks!");
				} else {
					$("#postscontent").html($("#postscontent").html() + data);
					$(".load-more").show();
				}
			}
		})
	}, 1);
}

$(window).on("load", function() {
	setInterval(function() {
		if ($(".load-more").length) {
			var ht1 = $(".load-more").offset().top;
			var ht2 = $("body").scrollTop() + window.innerHeight;
			if (ht2 >= ht1) {
				$(".load-more").click();
			}
		}
	}, 5000);
});

$(".follow-btn").click(function() {
	if ($(this).html() == "Follow") {
		$(this).removeClass("primary");
		$(this).html("Unfollow");
		$.get($(this).attr("data-user"));
	} else {
		$(this).addClass("primary");
		$(this).html("Follow");
		$.get($(this).attr("data-user"));
	}
});

$(".unfollow-btn").click(function() {
	if ($(this).html() == "Unfollow") {
		$(this).addClass("primary");
		$(this).html("Follow");
		$.get($(this).attr("data-user"));
	} else {
		$(this).removeClass("primary");
		$(this).html("Unfollow");
		$.get($(this).attr("data-user"));
	}
});

$(".new-edit-form").submit(function(e) {
	$("[name='content']").val($("#writecontent").html());
	$(this).submit();
	e.preventDefault();
	return false;
});

$("select[name='tags']").change(function() {
	console.log($(this).val());
	if ($(this).val() === "events") {
		$(".only-events").show();
	} else {
		$(".only-events").hide();
	}
});