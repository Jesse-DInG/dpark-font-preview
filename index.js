/**
 * Created by JesseDing  on 16/8/12.
 */
var express = require('express');
var path = require('path');
var app = express()
var fontimage = require('./server/api/fontimage');
//app.get('/', function (req, res) {
//  res.send('Hello World')
//})
app.get('/ajax/fontimage/get',fontimage.get);
app.use(express.static(path.join(__dirname, 'dist')));
app.use('/root',express.static(__dirname));

app.listen(process.env.PORT || 5050);
