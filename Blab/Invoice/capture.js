var page = require('webpage').create(),
system = require('system'),
address, output;
address = system.args[1];
output = system.args[2];

page.open(address, function(status) {
		page.render(output);
		phantom.exit();
});