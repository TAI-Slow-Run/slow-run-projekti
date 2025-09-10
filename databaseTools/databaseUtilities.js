/**
 * Sends data to server and awaits for response
 * @param {string} phpFilename - Php script which is required. Every Script has its own parameters. The `data` parameter holds this information
 * @param {FormData | any[]} data - Data that are the php script's parameter.
 * @param {boolean} mode - If true, data is an array that will be converted to JSON
 *                         If false, data is a FormData object (from `<form>...</form>` html element)
 * @returns {Promise<Object>} A promise that resolves with the JSON response.
 *                            If the Promise is resolved then it will return an JSON Object in the form of
 *                            `{success : any}`
 *                            If the Promise is rejected then it will return an JSON Object in the form of
 *                            `{error : message error}`
 */

/* if mode is false then the data is from form html element,
else is just a normal array of data which we have to convert to json format*/

export function getResponse(phpFilename, data, mode) {
    if(mode == false) {
        return fetch(phpFilename, { // sending data
            method : "POST",
            body : data
        })
        .then(response => { // receiving response
            if(!response.ok) { // an error has occured, e.g. wrong sql syntax
                return response.json().then(errorData => {
                    const error = new Error();
                    error.data = errorData;
                    throw error;
                });
            }
            return response.json();
        })
    } else {
        return fetch(phpFilename, { // sending data
            method : "POST",
            headers : {
                "Content-Type" : "application/json"
            },
            body : JSON.stringify({
                mainData : data
            })
        })
        .then(response => { // receiving response
            if(!response.ok) { // an error has occured, e.g. wrong sql syntax
                return response.json().then(errorData => {
                    const error = new Error();
                    error.data = errorData;
                    throw error;
                });
            }
            return response.json();
        })
    }
}

/**
 * Sends data to a PHP script and handles the response.
 * 
 * @param {Event | null} event - The event object from a `<form>` HTML element. If not provided, `dataArray` should be a valid array.
 * @param {string} phpFileName - The PHP script that will process the data.
 * @param {any[] | null} [dataArray=null] - Optional. Data that does **not** come from a `<form>` HTML element. If provided, `event` should be null and `dataArray` holds the parameters for the PHP script.
 * @returns {Promise<Object>} A promise that resolves with an object containing the following:
 *                             - `keyData`: the data returned from the PHP script.
 *                             - `status`: either "ok" if successful, or "error" if something went wrong.
 * 
 * If the promise is resolved, the `status` will be `"ok"` and the `keyData` will contain the successful response.
 * If the promise is rejected, the `status` will be `"error"` and `keyData` will contain the error message.
 */
export async function sendDataToServer(event = null, phpFileName, dataArray = null) {

    let data = null;
    let databaseData = null;
    let actualData = null;

    if(event != null) {
        event.preventDefault(); // disable the default behaviour of the submit button
    }

    if(!(event instanceof HTMLFormElement)) {
        event = event.target.form;
    } else {
        event = event.target;
    }
    
    try {
        if(dataArray == null) {
            data = new FormData(event)// data returned from the <form>...</form>
            databaseData = await getResponse(phpFileName, data, false); //Data from the database. The function will pause here until data is returned from the server
        } else {
            databaseData = await getResponse(phpFileName, dataArray, true); //Data from the database. The function will pause here until data is returned from the server
        }

        actualData = {"keyData" : databaseData["success"], "status" : "ok"}; // Every php  script returns {success : <actual data here>} if we do NOT have any errors
    } catch(error) {
        actualData = {"keyData" : error.data["error"], "status" : "error"}; //  // Every php  script returns {error : <actual data here>} if we HAVE any errors
    }

    console.log("Printing json object");
    console.log(actualData);
    console.log("**************************");

    return actualData;
    
}

/**
 * Fetches data from the database
 * @param {string} tableName - The table's name from the database
 * @param {string[]} fields - The fields of the table which are saved into an array 
 * @param {string[] | null} [orderByFields = null] - (Optional) Which field we want the data ordered by
 * @returns {Promise<Object>} A promise which resolves containing:
 *                            - {keyData : [fieldNames, rowData], status: "ok"} if promise is resolved
 *                            - {keyData : Error message, status : "error"} if promise is rejected
 */

export async function receiveData(tableName, fields, orderByFields = null) {
    let databaseData = null;
    //Data from the database. The function below will pause here until data is returned from the server
    //receiveData.php has 3 parameter: tablebame, fields array and fields to order array.
    if(fields == null) {
        databaseData = await sendDataToServer(null, "receiveData.php", [tableName, ["*"], orderByFields]);
    } else {
        databaseData = await sendDataToServer(null, "receiveData.php", [tableName, fields, orderByFields]);
    }
    return databaseData;
}

/**
 * Fetches data by a given query
 * @param {string} sqlStatement - SQL statement. Example: `SELECT * from tablename;`
 * @param {string} username - Administrator's username
 * @param {string} password - Administrator's  password
 * @returns {Promise<Object>} A promise which resolves containing:
 *                            - {keyData : [fieldNames, rowData], status: "ok"} if promise is resolved
 *                            - {keyData : Error message, status : "error"} if promise is rejected
 */

export async function receiveQueryingData(sqlStatement, username, password) {
    // receiveQueringData.php takes only one paramater, the sql statement
    return await sendDataToServer(null, "receiveQueryingData.php", [sqlStatement, username, password]);
}


/**
 * Redirects the user to another page using the GET method. Data can be redirected.
 * 
 * @param {string} redirectedPage - The name of the target file or page.
 * @param {any} [mainData=null] - Optional data to be transferred via the URL.
 *                                 The data is first converted to a JSON string and then URL-encoded.
 *                                 The final URL format will be: `redirectedPage?data=encodedData`.
 */

/* if we have to redirect to another page accompanied by data,
we have to convert it first */

export function redirect(redirectedPage, mainData = null) {
    if(mainData == null) {
        window.location.href = `${redirectedPage}`;
    } else {
        const encodedDataObject = encodeURIComponent(JSON.stringify(mainData));
        console.log(encodedDataObject);
        window.location.href = `${redirectedPage}?data=${encodedDataObject}`;
    }
}

/**
 * Gets the parameters from the URL.
 * 
 * @returns {Object | null} - The data is first decoded from URL encoding, then parsed into a JavaScript object.
 *                            Returns `null` if no data is found or if parsing fails.
 */

export function getDataFromURLParameters() {
    const urlParameters = new URLSearchParams(window.location.search);
    let data = null;
    if(urlParameters.get("data")) {
        data = urlParameters.get("data");
    } else {
        return null;
    }
    const decodeData = JSON.parse(decodeURIComponent(data));
    return decodeData;
}

/**
 * 
 * @param {string} text - String that main contain characters that would break the parsing of the text
 * @returns {string} - The same string but with escaped characters
 */

export function escapeSpecialHTMLCharacters(text) {
    if(text) {
        const element = document.createElement("div");
        element.innerText = text;
        return element.innerHTML;
    } else {
        return text;
    }
}

/**
 * Transforms data from the receivedData() or receivedQueryingData() function into a `<table>...</table>` HTML element.
 * Internally, strings are used to create a large string containing HTML elements.
 * To use this string, you should assign it to an `innerHTML` field.
 * Example: `document.getElementById(elementID).innerHTML = tabulateViaStrings(data)`
 * @param {any[][]} data - Data containing the column names and row results from a query.
 *                         `data[0]` is expected to be an array of column names,
 *                         and `data[1]` is expected to be an array of row data objects.
 * @returns {string} Returns the HTML table representation as a string.
 */

export function tabulateViaStrings(data) {
    const columnNames = data[0];
    const results = data[1];

    let tableHtml = "";

    tableHtml += "<table>";// tableHTML = tableHTML + "<table>"
        tableHtml += "<tr>";
            for(let i = 0; i < columnNames.length; i++) {
                tableHtml += `<th>${escapeSpecialHTMLCharacters(columnNames[i])}</th>`;
            }
        tableHtml += "</tr>";

        // Because the  data that results holds is NOT an array, row.length is undefined. However we know how many fields we have from columnNames which is an array. So columnNames.length is valid
        for(let row of results) {
            tableHtml += "<tr>";
                for(let i = 0; i < columnNames.length; i++) {
                    tableHtml += `<td>${escapeSpecialHTMLCharacters(row[i])}</td>`;
                }
            tableHtml += "</tr>";
        }
    tableHtml += "</table>";

    return tableHtml;
}

/**
 * Transforms data from the receivedData() or receivedQueryingData() function into a `<table>...</table>` HTML element.
 * Internally, elements are created using the document.createElement() method.
 * Since this function returns an `HTMLTableElement` object, it should be used differently from simple string-based table generation.
 * Example: `document.getElementById(elementID).appendChild(tabulateViaElements(data))`
 * @param {any[][]} data - Data containing the column names and row results from a query.
 *                         `data[0]` is expected to be an array of column names,
 *                         and `data[1]` is expected to be an array of row data objects.
 * @returns {HTMLTableElement} Returns an HTMLTableElement object.
 */

export function tabulateViaElements(data) {
    const columnNames = data[0]; 
    const results = data[1];

    const table = document.createElement("table");

    let tableRow = document.createElement("tr");
    for(let i = 0; i < columnNames.length; i++) {
        let tableColumn = document.createElement("th");
        tableColumn.innerText = columnNames[i];
        tableRow.appendChild(tableColumn);
    }
    table.appendChild(tableRow);

    // Because the  data that results holds is NOT an array, row.length is undefined. However we know how many fields we have from columnNames which is an array. So columnNames.length is valid
    for(let row of results) {
        tableRow = document.createElement("tr");
        for(let i = 0; i < columnNames.length; i++) {
            let tableColumn = document.createElement("td");
            tableColumn.innerText = row[i];
            tableRow.appendChild(tableColumn);
        }
        table.appendChild(tableRow);
    }

    return table;
}

/**
 * Capitalizes the first letter of a given string and converts the rest to lowercase.
 * 
 * @param {string} word - The string to be capitalized.
 * @returns {string} The capitalized string.
 */

export function capitalize(word) {
    if(word.length == 0)
        return word;

    return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
}

/**
 * Returns an array containing an HTMLLabelElement and an HTMLSelectElement created from the provided data returned by receivedData() and receivedQueryingData functions().
 * The function generates a label and a select dropdown based on the provided data.
 * Example usage:
 * - `document.getElementById(elementID).appendChild(listifyViaElements(data, commonName)[0]);`
 * - `document.getElementById(elementID).appendChild(listifyViaElements(data, commonName)[1]);`
 * 
 * @param {any[][]} data - Data containing the column names and row results from a query.
 *                         `data[0]` is expected to be an array of column names,
 *                         and `data[1]` is expected to be an array of row data objects.
 * @param {string} commonName - A name that will be set as the `for` attribute of the label,
 *                              and the `id` and `name` attributes of the select element.
 * @param {string} [emoji=""] - (Optional) An emoji to prepend(add to the beginning) to each option for better visual representation.
 * @returns {any[]} Returns an array containing two elements: `HTMLLabelElement` and `HTMLSelectElement`.
 */

export function listifyViaElements(data, commonName, emoji = "") {

    const results = data[1];

    const label = document.createElement("label");
    label.setAttribute("for", commonName.toLowerCase());
    label.innerText = `${capitalize(commonName)}: `;


    const list = document.createElement("select");
    list.setAttribute("id", commonName.toLowerCase());
    list.setAttribute("name", commonName.toLowerCase());

    for(let row of results){
        const option = document.createElement("option");
        option.setAttribute("value", row[0]);
        option.innerText = `${emoji} ${row[0]}`;
        for(let i = 1; i < data[0].length; i++) {
            option.innerText += `, ${row[i]}`;
        }
        list.appendChild(option);
    }

    return [label, list];
}

/**
 * Returns a string of HTML elements based on the provided data returned by the `receivedData()` and `receivedQueryingData()` functions.
 * This function generates a label and a select dropdown based on the provided data.
 * Example usage:
 * - `document.getElementById(elementID).innerHTML = listifyViaStrings(data, "courses", "📚");`
 * 
 * @param {any[][]} data - Data containing the column names and row results from a query.
 *                         `data[0]` is expected to be an array of column names,
 *                         and `data[1]` is expected to be an array of row data objects.
 * @param {string} commonName - A name that will be set as the `for` attribute of the label,
 *                              and the `id` and `name` attributes of the select element.
 * @param {string} [emoji = ""] - (Optional) An emoji to prepend (add to the beginning) each option for better visual representation.
 * @returns {string} Returns a string representation of the `label` and `select` elements.
 */

export function listifyViaStrings(data, commonName, emoji = "") {
    const results = data[1];

    let listHTML = "";

    listHTML += `<label for = '${commonName.toLowerCase()}'>${capitalize(commonName)}: </label>`
    listHTML += `<select id = '${commonName.toLowerCase()}' name = '${commonName.toLowerCase()}'>`;
        for(let row of results) {
            listHTML += `<option value = ${row[0]}>${emoji} ${row[0]}`;
            for(let i = 1; i < data[0].length; i++) { // data[0] holds the names of the columns which is an array. So data[0].length is valid
                listHTML += `, ${escapeSpecialHTMLCharacters(row[i])}`;
            }
            listHTML += "</option>";
        }
    listHTML += "</select>"

    return listHTML;
}

/**
 * 
 * @param {string} filename - the path of the file
 * @param {number[]} displayedFieldsOrder - rearrange a csv line seperated by comma. 
 *                                        Example: "fire,water,earth".
 *                                        The end result is an array: `const tokens = ["fire","water","earth"]`.
 *                                        The index of an array starts from 0. So:
 *                                        tokens[0] = "fire", tokens[1] = "water", tokens[2] = "earth"
 *                                        if we want change the order to ["earth", "fire", "water"] then
 *                                        displayedFieldsOrder should be this: [2,0,1]
 * @param {boolean} [uniqueValues = false] - If `true`, the data returned from the file will be unique and no duplicates will exist.
 *                                         - If `false`, the data returned from the file will have duplicates.
 * @returns {Promise<Object>} A promise that resolves with an object containing the following:
 *                             - `keyData`: the data returned from the PHP script.
 *                             - `status`: either "ok" if successful, or "error" if something went wrong.
 * 
 * If the promise is resolved, the `status` will be `"ok"` and the `keyData` will contain the successful response.
 * If the promise is rejected, the `status` will be `"error"` and `keyData` will contain the error message.
 */
export async function loadCSVFile(filename, displayedFieldsOrder, uniqueValues = false) {
    return await sendDataToServer(null, "readFile.php", [filename, displayedFieldsOrder, uniqueValues]);
}