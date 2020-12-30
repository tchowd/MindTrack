//Menu Bar code taken from video: Responsive Admin Dashboard Layout With Html Css Grid by YouTube channel CodersBite
var sidebarOpen = false;
var sidebar = document.getElementById("sidebar");
var sidebarCloseIcon = document.getElementById("sidebarIcon");

function toggleSidebar() {
    if (!sidebarOpen) {
        sidebar.classList.add("sidebar_responsive");
        sidebarOpen = true;
    }
}

function closeSidebar() {
    if (sidebarOpen) {
        sidebar.classList.remove("sidebar_responsive");
        sidebarOpen = false;
    }
}

// TODOLIST 
const addButton = document.querySelector('.addButton')
const input = document.querySelector('.input')
const todocontainer = document.querySelector('.todocontainer')

class item {
    constructor(itemName) {
        this.createDiv(itemName);
    }
    createDiv(itemName) {
        let input = document.createElement('input');
        input.value = itemName;
        input.disabled = true;
        input.classList.add('item-input');
        input.type = 'text';
        
        let itemBox = document.createElement('div');
        itemBox.classList.add('item');

        let editButton = document.createElement('button');
        editButton.innerHTML = 'edit';
        editButton.classList.add('editButton');

        let removeButton = document.createElement('button');
        removeButton.innerHTML = 'remove';
        removeButton.classList.add('removeButton');

        todocontainer.appendChild(itemBox);

        itemBox.appendChild(input);
        itemBox.appendChild(editButton);
        itemBox.appendChild(removeButton);

        editButton.addEventListener('click', () => this.edit(input));

        removeButton.addEventListener('click', () => this.remove(itemBox));

    }
    edit(input) {
        input.disabled = !input.disabled;
    }

    remove(item) {
        todocontainer.removeChild(item);
    }
}

function check() {
    if(input.value != '') {
        new item(input.value);
        input.value = '';
    }
}


addButton.addEventListener('click', check);
window.addEventListener('keydown', (e) => {
    if(e.which == 13) {
        check();
    }
})

//CALENDAR code completed with the help of video: Calendar with HTML, CSS, and JavaScript - How to build calendar using HTML, CSS, and JavaScript by YouTube channel Code and Create
//Helps user view months and days of the given year in the form of a calendar
const date = new Date();

const calendar = () => {
  date.setDate(1);

  const monthDays = document.querySelector(".days");

  const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
  const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate();

  const firstDayIndex = date.getDay();
  const lastDayIndex = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDay();

  const nextDays = 7 - lastDayIndex - 1;

  const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

  document.querySelector(".date h1").innerHTML = months[date.getMonth()];
  document.querySelector(".date p").innerHTML = new Date().toDateString();

  let days = "";

  for (let n = firstDayIndex; n > 0; n--) {
    days += `<div class="prev-date">${prevLastDay - n + 1}</div>`;
  }

  for (let k = 1; k <= lastDay; k++) {

    if (k === new Date().getDate() && date.getMonth() === new Date().getMonth()) {
      days += `<div class="today">${k}</div>`;
    } else {
      days += `<div>${k}</div>`;
    }

  }

  for (let m = 1; m <= nextDays; m++) {
    days += `<div class="next-date">${m}</div>`;
    monthDays.innerHTML = days;
  }

};

document.querySelector(".prev").addEventListener("click", () => {
  date.setMonth(date.getMonth() - 1);
  calendar();
});

document.querySelector(".next").addEventListener("click", () => {
  date.setMonth(date.getMonth() + 1);
  calendar();
});

calendar();

//Light and dark theme code taken from dev.to's page called Create A Dark/Light Mode Switch with CSS Variables
//Animates theme switch 
const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');

function switchTheme(e) {
  if (e.target.checked) {
      document.documentElement.setAttribute('data-theme', 'dark');
      localStorage.setItem('theme', 'dark'); //add this
  }
  else {
      document.documentElement.setAttribute('data-theme', 'light');
      localStorage.setItem('theme', 'light'); //add this
  }    
}

toggleSwitch.addEventListener('change', switchTheme, false);

const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : null;

if (currentTheme) {
    document.documentElement.setAttribute('data-theme', currentTheme);

    if (currentTheme === 'dark') {
        toggleSwitch.checked = true;
    }
}


//quote generator 
let btn = document.getElementById('btn')
let output = document.getElementById('output');
let quotes = [
  '"The greatest glory in living lies not in never falling, but in rising every time we fall." -Nelson Mandela',
  '"The way to get started is to quit talking and begin doing." -Walt Disney',
  '"Your time is limited, so dont waste it living someone elses life. Dont be trapped by dogma – which is living with the results of other peoples thinking." -Steve Jobs',
  '"If life were predictable it would cease to be life, and be without flavor." -Eleanor Roosevelt',
  '"If you look at what you have in life, youll always have more. If you look at what you dont have in life, youll never have enough." -Oprah Winfrey',
  '"If you set your goals ridiculously high and its a failure, you will fail above everyone elses success." -James Cameron',
  '"Life is what happens when youre busy making other plans." -John Lennon',
];

btn.addEventListener('click', function(){
  var ran__quote = quotes[Math.floor(Math.random() * quotes.length)]
  output.innerHTML = ran__quote;
})