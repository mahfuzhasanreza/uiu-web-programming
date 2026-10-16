const CALORIE_GOAL = 2000;

let calorieInput = document.getElementById("calorieInput");
let addButton = document.getElementById("addButton");
let label = document.getElementById("label");

let totalCalories = 0;
let feedbackMessage = "";
let totalEntries = 0;

addButton.addEventListener("click", calculateCalories);

function calculateCalories(){
    let calorieValue = calorieInput.value;

    totalEntries++;
    totalCalories += Number(calorieValue);

    if(totalCalories>=0 && totalCalories<=800){
        feedbackMessage = "You're off to a healthy start!";
    } else if(totalCalories>=801 && totalCalories<=1600){
        feedbackMessage = "Good progress, keep it balanced!"
    } else if(totalCalories>=1601 && totalCalories<=1999){
        feedbackMessage = "Almost at your limit!"
    } else if(totalCalories>=2000){
        feedbackMessage = "Goal reached! Stay mindful!"
    }


    if(totalEntries>10 && totalCalories<CALORIE_GOAL){
        feedbackMessage = "Be cautious of frequent snacking!"
    }

    label.textContent = "Total Calories: " + totalCalories + ", Number of Entries: " + totalEntries + ", Feedback: " + feedbackMessage;
}