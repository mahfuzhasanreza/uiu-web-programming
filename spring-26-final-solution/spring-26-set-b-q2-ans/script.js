let heartRates = [];
let oxygenLevels = [];
let totalHeartRate = 0;
let totalOxygenLevel = 0;
let entryCount = 0;
let feedback = "";

function generateReport(){
    let heartRate = Number(document.getElementById("heartRate").value);
    let oxygenLevel = Number(document.getElementById("spo2").value);

    heartRates.push(heartRate);
    oxygenLevels.push(oxygenLevel);

    totalHeartRate += heartRate;
    totalOxygenLevel += oxygenLevel;
    entryCount++;

    let avgHeartRate = (totalHeartRate / entryCount);
    let avgOxygenLevel = totalOxygenLevel / entryCount;

    let riskScore = (100 - oxygenLevel) * 2 + Math.abs(heartRate - 80) * 0.5;

    if(riskScore <= 10){
        feedback = "SAFE";
    } else if(riskScore > 10 && riskScore <= 20){
        feedback = "WARNING";
    } else if(riskScore > 20){
        feedback = "DANGER";
    }

    // document.getElementById("outputText").textContent = "Average Heart Rate: " + avgHeartRate + ", Average Oxygen Saturation: " + avgOxygenLevel + ", Risk Score: " + riskScore + ", Feedback: " + feedback; 

    document.getElementById("outputText").innerHTML = "Average Heart Rate: " + avgHeartRate + "<br>Average Oxygen Saturation: " + avgOxygenLevel + "<br>Risk Score: " + riskScore + "<br>Feedback: " + feedback; 
}