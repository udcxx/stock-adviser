let requestURL = 'https://script.google.com/macros/s/AKfycbwB78CavYLPBMSsfNqypLuaArDMXYa9nsQuki7gLT0uvmhpr6Ool-l4uw/exec';
let request = new XMLHttpRequest();
request.open('GET', requestURL);
request.responseType = 'json';
request.send();

request.onload = function() {
    const json = request.response;
    /* 
        00.証券コード  01.前日終値  02.配当  03.配当性向  04.配当利回り  05.証券コード最終更新日
        06.決算月  07.過去配当最終更新日  08.最新決算年度  09.配当 1期前  10.配当 2期前  
        11.配当 3期前  12.配当 4期前  13.配当 5期前  14.性向 1期前  15.性向 2期前
        16.性向 3期前  17.性向 4期前  18.性向 5期前  19.過去配当評価  20.過去性向評価
        21.現在性向評価  22.現在利回り評価  23.総合評価
    */

    let formedData = [];

    for (const line of json) {
        let datas = [];

        datas.push(line[0]);
        datas.push(line[2]);
        datas.push(line[3]);
        datas.push(line[19]);
        datas.push(line[20]);
        datas.push(line[21]);
        datas.push(line[22]);
        datas.push(line[23]);

        if(line[23] >= 18) {
            datas.push("🙆‍♂️");
        } else {
            datas.push("");
        }

        formedData.push(datas);
    }

    new gridjs.Grid({
        columns: ["コード", "配当金", "配当性向", "評価 1", "評価 2", "評価 3", "評価 4", "総合評価", "🤔"],
        data: formedData,
        sort: true,
        pagination: {
            enabled: true,
            limit: 20,
            summary: false
          }
      }).render(document.getElementById("json"));
}
