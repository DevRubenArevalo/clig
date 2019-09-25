<html>
<body>
<style>
    #grid {
        background:white;
        float:right;
    }
</style>
<script src="js/jQuery-v3.4.1.js"></script>
    <canvas id="grid"></canvas>
    <script>
        let grid_size = 8;
        let tile_size = 20;
        let $canvas = $('#grid');

        let canvas_size = grid_size * tile_size;
        let colors = {
          B: [0, 0, 255],
          R: [0, 255, 0],
          G: [255, 0, 0],
          Y: [255, 255, 0],
          P: [128, 0, 128],
        };

        $canvas.attr('width',canvas_size).attr('height',canvas_size);

        function newElement(x,y) {
            const obj = {};
            obj.color = getRandomElementType();
            if(typeof(colors[obj.color]) !== "undefined") {
                obj.fillStyle = "rgb(" + colors[obj.color][0] + ", " + colors[obj.color][1] + ", " + colors[obj.color][2] + ")"
            }
            //obj.fillStyle = 'rgb(' + tile_size + ', ' + x + ', '+ y + ')';
            obj.fillRect = {
                p1: x * tile_size,
                p2: y * tile_size,
                p3: x * tile_size + tile_size,
                p4: y * tile_size + tile_size
            };

            obj.draw = function(context) {
                context.fillStyle = obj.fillStyle;
                context.fillRect = obj.fillStyle;
                // ctx.fillStyle = 'rgb(200, 0, 0)';
                // ctx.fillRect(10, 10, 50, 50);

            };

            return obj;
        }

        // Give random color
        function getRandomElementType() {
            let types = ['B','R','G','Y','P'];
            return types[Math.floor(Math.random()*types.length)];
        }





        function newGrid(grid) {
            let canvas = document.getElementById('grid');
            const obj = {};

            if (canvas.getContext) {
                obj.ctx = canvas.getContext('2d');

                // drawing code here
                // ctx.fillStyle = 'rgb(200, 0, 0)';
                // ctx.fillRect(10, 10, 50, 50);
                //
                // ctx.fillStyle = 'rgba(0, 0, 200, 0.5)';
                // ctx.fillRect(30, 30, 50, 50);
            } else {
                alert('Nah dude canvas does not work.');
                // canvas-unsupported code here
            }


            //todo: draw function - loops through each of the indexes and runs the draw function on each new element.
            obj.draw = function() {
                for(let x=0;x<grid.length;x++) {
                    for(let y=0; y < grid[x].length;y++) {
                        grid[x][y].draw(obj.ctx);
                    }
                }
            };


        }

        // Initialize array
        let grid = new Array(grid_size);               // 10 rows of the table
        for(let i = 0; i < grid.length; i++)
            grid[i] = new Array(grid_size);            // Each row has 10 columns

        // Give random values for grid.
        for(let x = 0; x < grid.length; x++) {
            for(let y = 0; y < grid[x].length; y++) {
                grid[x][y] = newElement(x,y);
            }
        }

console.log(grid);

        //todo: associate each value with a color.

        // todo: draw each index as a square for now.

        //
        // ctx.fillStyle = 'rgb(200, 0, 0)';
        // ctx.fillRect(10, 10, 50, 50);


    </script>
</body>
</html>