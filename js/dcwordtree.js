function draw(container, words, width) {
	var height = width*3/4;
	d3.select(container)
		.append("svg")
		.attr("width", width)
		.attr("height", height)
		.append("g")
		.attr("transform", "translate("+width/2+","+height/2+")")
		.selectAll("text")
		.data(words)
		.enter().append("text")
		.style("font-size", function(d) {
			return d.size + "px";
		})
		.style("font-family", "Impact")
		.style("fill", function(d, i) {
			return fill(i);
		})
		.attr("text-anchor", "middle")
		.attr("transform", function(d) {
			return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
		})
		.text(function(d) {
			return d.text;
		})
		.on("click", function(d) {
			window.location = d.url;
		});
}

$(function() {
	var words = [];
	$('#content .tags li a').each(function(i) {
		words.push({text: $(this).text(),
			    size: 20 + parseInt($(this).attr('class').replace(/^tag/, ''), 10) * 0.7,
			    url: $(this).attr('href')
			   });
	});

	$('#content .tags').hide();
	d3.layout.cloud().size([width, height])
		.words(words)
		.padding(padding)
		.rotate(function() { return ~~(Math.random() * 2) * 90; })
		.font("Impact")
		.fontSize(function(d) { return d.size; })
		.on("end", function() { draw('#content', words, $('#content').width());})
		.start();
});
