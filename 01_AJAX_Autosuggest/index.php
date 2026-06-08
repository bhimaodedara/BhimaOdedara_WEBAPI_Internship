<!DOCTYPE html>
<html>
<head>
    <title>Internship search by mode</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        select { padding: 10px; font-size: 16px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f5f5f5; }
    </style>
    <script>
    function getStudents(mode) {
        if (mode.length == 0) {
            document.getElementById("result").innerHTML = "";
            return;
        }

        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("result").innerHTML = xhr.responseText;
            }
        };

        xhr.open("GET", "search.php?mode=" + encodeURIComponent(mode), true);
        
        xhr.send(); 
    }
    </script>
</head>
<body>

    <h2>Search interns by mode</h2>

    <select id="modeSelect" onchange="getStudents(this.value)">
        <option value=""> Select Mode</option>
        <option value="online">Online</option>
        <option value="onsite">Onsite</option>
        <option value="hybrid">Hybrid</option>
    </select>

    <div id="result">
        </div>

</body>
</html>