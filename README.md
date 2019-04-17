# Social Financial Platform
Personal project, financial platform built with PHP _awesome_ little ToDo list App - [View Demo](http://esankole.gq/todolist/)

[![Practice](https://img.shields.io/badge/Practice-JavaScript-yellow.svg)](http://www.esankole.gq/todolist/)

_<p align="center">"Teach me Sensei - I wish to learn the Ways of JavaScript"_</p>

<div align="center" style="text-align:center; margin:auto;">
<img align="center" src="https://i.imgur.com/SeUttrI.png" width="150"/>
</div>

## What it is
A simple, learning Project to practice JavaScript Programming Fundamentals. Built with:
* HTML
* Vanilla JS - ES5 & ES6
* [Materialize CSS](http://www.materializecss.com/) - Material Design CSS FrameWork
* [Google Material Icons](https://google.github.io/material-design-icons/) - Icon Font
* [LOVE](https://www.wikihow.com/Love-Programming) - Strictly for the love of coding _Mehn!_

## What it does

* Add & Delete ToDo Items
* ToDo List Badge Counter
* Search/Filter ToDo List
* Clear ToDo List
* Persist Data in Local Storage
* Quirky, random ToDo suggestions

## Learning Points
* DOM Manipulation & Traversal
* Event Handing & Delegation
* Creating & Appending Elements
* Local Storage Object Methods
* Materialize Alerts & Toasts

## Some cool stuff
Just about ___Everyone___ makes a todo list when learning Front End programming), so I figured I'd spice things up - tossed in a random placeholder generating function: 
```javascript
function randomPlaceHolder(){
  const placeHolders = ['array','of','silly','placeholders'];
  const index = Math.floor((Math.random()* placeHolders.length) +1);
  todoInput.setAttribute('placeHolder',placeHolders[index]);
}
``` 
Also chose to use [Materialize CSS Toasts](https://materializecss.com/toasts.html) instead of crappy window methods (like `alert()` and `confirm()`). Added the ToDo Counter Badge as well.
```javascript
M.init(); // Initializes Materialize JS
M.toast({html:'',displayLength:1200});
```
## Features in Development
  Still working on these (its just laziness that's made me not get around to em yet though, but you can tell from the UI they're supposed to be there)
* Edit ToDo List Items
* Undo Clear & Delete Items

## Contribution
Contributions are highly welcome. Feel free to fork, clone, make pull requests, report issues etc.

## Acknowledgments

* Many thanks to [@bradtraversy](https://github.com/bradtraversy) for his awesome courses - _i will not fail you sensei_
* Thanks to [@torvalds](https://github.com/torvalds) For Making the world a better place
* And To anyone reading this... _You're awesome!_

That being said
_<p align="center">Adieu, I must return to Code mountain to continue my training the Ways of  Ninjustu</p>_