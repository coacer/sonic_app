const fetchGraphData = async (date, type) => {
  if (date === "now") {
    const { data } = await axios.get(`/api/analysis/${type}`);
    if (type === "monthly") {
      const month = Object.keys(data);
      const count = Object.values(data);
      return { month, count };
    } else if (type === "experienced" || type === "medium") {
      const labels = Object.keys(data);
      const graphData = Object.values(data);
      return { labels, data: graphData };
    }
    return data;
  }

  // Lambda関数のエンドポイントをdateをパラメータにして叩く
  const params = { date };
  const { data } = await axios.get("https://lambda-api", { params });
  console.log("===== DynamoDB! =====");
  // Promiseオブジェクトとしてtypeに応じたdataを渡す
  console.log(data);
  console.log(data[type]);
  return data[type];
};

export default fetchGraphData;
