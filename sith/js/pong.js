var animate = window.requestAnimationFrame ||
windo.webkitRequestAnimationFrame ||
window.mozRequestAnimationFrame ||
function(callback) {window.setTimeout(callback, 1000/60)};

var canvas = document.createElement('canvas');
var width = 600;
var height = 400;
canvas.width = width;
canvas.height = height;
var context = canvas.getContext('2d');

function Paddle(x, y, width, height) {
	this.x = x;
	this.y = y;
	this.width = width;
	this.height = height;
	this.x_speed = 0;
	this.y_speed = 0;
}


function Player() {
	this.paddle = new Paddle(80, height/2 - 50, 10, 100);
}

Player.prototype.render = function() {
	context.fillStyle = "#000000";
	context.fillRect(this.paddle.x, this.paddle.y, this.paddle.width, this.paddle.height);
	context.fillRect(this.paddle.x - 20, this.paddle.y, this.paddle.width, this.paddle.height / 2);
	context.fillRect(this.paddle.x - 20, this.paddle.y + this.paddle.height / 2, this.paddle.width * 3, this.paddle.width);
};

function Computer() {
	this.paddle = new Paddle(520, height/2 -50, 10, 100);
}

Computer.prototype.render = function() {
	context.fillStyle = "#000000";
	context.fillRect(this.paddle.x, this.paddle.y, this.paddle.width, this.paddle.height);
	context.fillRect(this.paddle.x + 20, this.paddle.y, this.paddle.width, this.paddle.height / 2);
	context.fillRect(this.paddle.x, this.paddle.y + this.paddle.height / 2, this.paddle.width * 3, this.paddle.width);
};

Computer.prototype.update = function(ball) {
	var y_pos = ball.y;
	var diff = -((this.paddle.y + (this.paddle.height / 2)) - y_pos);
	if(diff < 0 && diff < -4) { // max speed left
		diff = -5;
	} else if(diff > 0 && diff > 4) { // max speed right
		diff = 5;
	}
	this.paddle.move(0, diff);
	if(this.paddle.y < 0) {
		this.paddle.y = 0;
	} else if (this.paddle.y + this.paddle.height > height) {
		this.paddle.y = height - this.paddle.height;
	}
};

Player.prototype.update = function() {
	for(var key in keysDown) {
		var value = Number(key);
		if(value == 38) { // up arrow
			this.paddle.move(0, -4);
		} else if (value == 40) { // down arrow
			this.paddle.move(0, 4);
		} else {
			this.paddle.move(0, 0);
		}
	}
};

Paddle.prototype.move = function(x, y) {
	this.x += x;
	this.y += y;
	this.x_speed = x;
	this.y_speed = y;
	if(this.y < 0) { // all the way to the top
		this.y = 0;
		this.y_speed = 0;
	} else if (this.y + this.height > height) { // all the way to the bottom
		this.y = height - this.height;
		this.y_speed = 0;
	}
}


function Ball(x, y) {
	this.x = x;
	this.y = y;
	this.x_speed = 2;
	this.y_speed = 0;
	this.radius = 25;
}

Ball.prototype.render = function() {
	context.beginPath();
	context.arc(this.x, this.y, this.radius, 2 * Math.PI, false);
	context.fillStyle = "#000000";
	context.fill();

	context.beginPath();
	context.arc(this.x, this.y, this.radius * 0.7, 2 * Math.PI, false);
	context.fillStyle = "#FFFFFF";
	context.fill();
};

Ball.prototype.update = function(paddle1, paddle2) {
	this.x += this.x_speed;
	this.y += this.y_speed;
	var x_top = this.x - this.radius;
	var y_top = this.y - this.radius;
	var x_bottom = this.x + this.radius;
	var y_bottom = this.y + this.radius;

	if(y_top < 0) {
		this.y = this.radius + 1;
		this.y_speed = -this.y_speed;
	} else if (y_bottom > height) {
		this.y = height - this.radius -1;
		this.y_speed = -this.y_speed;
	}

	if(this.x < 0 || this.x > width) {
		this.x_speed = 3;
		this.y_speed = 0;
		this.x = width/2;
		this.y = height/2;
	}

	if(x_bottom > paddle2.x && x_bottom < paddle2.x + paddle2.width) {
		if(this.y > paddle2.y && this.y < paddle2.y + paddle2.height ) {
			this.x_speed = -3;
			this.y_speed += (paddle2.y_speed / 2);
		}
	} else if (x_top < paddle1.x + paddle1.width && x_bottom > paddle1.x) {
		if(this.y > paddle1.y && this.y < paddle1.y + paddle1.height) {
			this.x_speed = 3;
			this.y_speed += (paddle1.y_speed / 2);
		}
	}
}

var keysDown = {};

window.addEventListener("keydown", function(event) {
	keysDown[event.keyCode] = true;
});

window.addEventListener("keyup", function(event) {
	delete keysDown[event.keyCode];
});

var player = new Player();
var computer = new Computer();
var ball = new Ball(width/2, height/2);

var render = function() {
	context.fillStyle = 'rgba(255, 255, 255, 0.5)';
	context.fillRect(0, 0, width, height);
	player.render();
	computer.render();
	ball.render();
};

var update = function() {
	ball.update(player.paddle, computer.paddle);
	player.update();
	computer.update(ball);
};

var step = function() {
	update();
	render();
	animate(step);
};

window.onload = function() {
	document.getElementById("pong").appendChild(canvas);
	animate(step);
};
