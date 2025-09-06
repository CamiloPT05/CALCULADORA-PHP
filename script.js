document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("calc-form");
  const inputs = {
    n1: document.getElementById("numero1"),
    n2: document.getElementById("numero2"),
  };
  const out = {
    value: document.getElementById("resultado"),
    detail: document.getElementById("detalle"),
  };

  function asNumber(v) {
    const num = Number(v);
    return Number.isFinite(num) ? num : null;
  }

  async function calcular(operacion) {
    const n1 = asNumber(inputs.n1.value);
    const n2 = asNumber(inputs.n2.value);

    if (n1 === null || n2 === null) {
      out.value.textContent = "Ingresa ambos números.";
      out.detail.textContent = "";
      return;
    }

    out.value.textContent = "Calculando…";
    out.detail.textContent = "";

    try {
      const res = await fetch("calculos.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ numero1: n1, numero2: n2, operacion }),
      });

      const data = await res.json();

      if (!res.ok || data.success === false) {
        out.value.textContent = data?.mensaje ?? "Error al calcular";
        out.detail.textContent = "";
        return;
      }

      const fmt = new Intl.NumberFormat("es-CO", { maximumFractionDigits: 6 });
      const v = (typeof data.resultado === "number")
        ? fmt.format(data.resultado)
        : String(data.resultado);

      out.value.textContent = v;
      out.detail.textContent = data.mensaje || `${operacion} realizado correctamente.`;
    } catch (err) {
      console.error(err);
      out.value.textContent = "No hay conexión con el servidor.";
      out.detail.textContent = "";
    }
  }

  document.querySelector(".actions").addEventListener("click", (e) => {
    const btn = e.target.closest("button");
    if (!btn || !btn.dataset.op) return;
    calcular(btn.dataset.op);
  });

  document.getElementById("limpiar").addEventListener("click", () => {
    inputs.n1.value = "";
    inputs.n2.value = "";
    out.value.textContent = "—";
    out.detail.textContent = "";
    inputs.n1.focus();
  });
});
