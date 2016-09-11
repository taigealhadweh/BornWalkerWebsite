
var url = "http://www.arpansa.gov.au/uvindex/realtime/xml/uvvalues.xml";
var xml = new JKL.ParseXML(url);
var data = xml.parse();
document.write(data["stations"]["melbourne"]["index"]);
document.write(data.stations.melbourne.index);