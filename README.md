# MuzikAra
Get mp3 links JSON format from internet

* **URL**

  /?q=:q

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 
   `q=[string]`

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{
    "0": {
        "resim": [
            ""
        ],
        "isim": [
            ""
        ],
        "link": [
            ""
        ]
    }, 
    "next_link": [
        "L2FyYS9tZWxlay1tb3Nzby8y"
    ]}`
* **Sample Call:**

  ```javascript
    $.ajax({
      url: "/?q=rihanna",
      dataType: "json",
      type : "GET",
      success : function(r) {
        console.log(r);
      }
    });
  ```
  
* **URL**
(Get next_link from ?q= request for next page)

  /?url=:next_link

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 
   `url=[next_link]`


* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{
    "0": {
        "resim": [
            ""
        ],
        "isim": [
            ""
        ],
        "link": [
            ""
        ]
    }, 
    "next_link": [
        "L2FyYS9tZWxlay1tb3Nzby8y"
    ]}`
    
* **Sample Call:**

  ```javascript
    $.ajax({
      url: "/?url=next_link",
      dataType: "json",
      type : "GET",
      success : function(s) {
        console.log(s);
      }
    });
  ```
 
  
* **URL**
(Get next_link from ?q= request for next page)

  /?link=:link

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 
   `link=[link]`


* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{
    "link": [
        "mp3 link"
    ],
    "title": [
        "title"
    ]
}`
    
* **Sample Call:**

  ```javascript
    $.ajax({
      url: "/?link=link",
      dataType: "json",
      type : "GET",
      success : function(x) {
        console.log(x);
      }
    });
  ```
